import { InitialFilesProps } from '@/Components/Forms/MultipleUploadFiles/hooks/useUploadFiles/types';
import { TrashIcon } from '@/Components/Icons/Trash';
import { useDialog } from '@/Context/Dialog';
import { useCommonService } from '@/Hooks/useCommonService';
import { useMotorcycleService } from '@/Hooks/useMotorcycleService';
import { APIRoutes } from '@/constants';
import { Motorcycle } from '@/models/Motorcycle';
import { MotorcycleOptional } from '@/models/MotorcycleOptional';
import { useForm } from '@inertiajs/react';
import axios from 'axios';
import { ChangeEvent, FormEvent, useEffect, useMemo, useState } from 'react';
import { MotorcycleSchema } from '../../types';
import { UseMotorcycleFormProps } from './types';

export const useMotorcycleForm = ({
  postUrl,
  defaultValues,
  images,
}: UseMotorcycleFormProps) => {
  const [currentFiles, setCurrentFiles] = useState<Motorcycle['images']>(
    images ?? [],
  );
  const [optionalState, setOptionalState] = useState<MotorcycleOptional[]>([]);
  const currentYear = useMemo(() => new Date().getFullYear(), []);
  const commonService = useCommonService();
  const motorcycleService = useMotorcycleService();
  const { openDialog } = useDialog();

  const { data, post, setData, ...form } = useForm<MotorcycleSchema>({
    year: currentYear,
    manufacturingYear: currentYear,
    optionals: [],
    color: undefined,
    ...defaultValues,
  });

  const handleOptionalsChange = (
    e: ChangeEvent<HTMLInputElement>,
    id: number,
  ) => {
    const isChecked = e.target.checked;
    const currentOptionals = (data.optionals ?? []) as number[];
    if (isChecked) {
      setData('optionals', [...currentOptionals, id]);
      return;
    }

    setData(
      'optionals',
      currentOptionals.filter((optional) => optional !== id),
    );
  };

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    post(postUrl);
  };

  const handleCreateModel = (search: string) => {
    return motorcycleService.createModel(search, data.brand!);
  };

  const handleDeleteFile = ({ id }: InitialFilesProps) => {
    openDialog({
      content: {
        title: 'Deseja excluir a imagem?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;

        axios
          .delete(route(APIRoutes.MOTO_IMAGE_DELETE, { id }))
          .then(() =>
            setCurrentFiles((prev) => prev?.filter((img) => img.id != id)),
          );
      },
    });
  };

  const selectedFiles = useMemo(
    () =>
      (currentFiles ?? []).map((file) => ({
        name: file.url,
        id: String(file.id),
        order: file.order,
      })),
    [currentFiles],
  );

  useEffect(() => {
    axios
      .get(route(APIRoutes.MOTO_OPTIONALS_LIST))
      .then((res) => setOptionalState(res.data));
  }, []);

  return {
    data,
    setData,
    ...form,
    commonService,
    selectedFiles,
    currentYear,
    motorcycleService,
    optionalList: optionalState,
    onSubmit: handleSubmit,
    handleCreateModel,
    handleDeleteFile,
    handleOptionalsChange,
  };
};
