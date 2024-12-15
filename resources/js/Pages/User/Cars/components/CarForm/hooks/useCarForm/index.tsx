import { InitialFilesProps } from '@/Components/Forms/MultipleUploadFiles/hooks/useUploadFiles/types';
import { TrashIcon } from '@/Components/Icons/Trash';
import { useDialog } from '@/Context/Dialog';
import { useCarService } from '@/Hooks/useCarService';
import { useCommonService } from '@/Hooks/useCommonService';
import { APIRoutes } from '@/constants';
import { Car } from '@/models/Car';
import { CarOptional } from '@/models/VehicleOptional';
import { useForm } from '@inertiajs/react';
import axios from 'axios';
import { ChangeEvent, FormEvent, useEffect, useMemo, useState } from 'react';
import { CarFormSchema } from '../../types';
import { UseCarFormProps } from './type';

export const useCarForm = ({
  postUrl,
  defaultValues,
  images,
}: UseCarFormProps) => {
  const currentYear = useMemo(() => new Date().getFullYear(), []);
  const { openDialog } = useDialog();
  const [currentFiles, setCurrentFiles] = useState<Car['images']>(images);
  const [optionalState, setOptionalState] = useState<CarOptional[]>([]);
  const commonService = useCommonService();
  const carService = useCarService();

  const { data, setData, errors, post, isDirty } = useForm<CarFormSchema>({
    year: currentYear,
    manufacturingYear: currentYear,
    optionals: [],
    transmission: undefined,
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
    return carService.createModel(search, data.brand!);
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
          .delete(route(APIRoutes.CAR_IMAGE_DELETE, { id }))
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
      .get(route(APIRoutes.CAR_OPTIONALS_LIST))
      .then((res) => setOptionalState(res.data));
  }, []);

  return {
    data,
    setData,
    errors,
    post,
    isDirty,
    onSubmit: handleSubmit,
    commonService,
    selectedFiles,
    carService,
    currentYear,
    optionalList: optionalState,
    handleCreateModel,
    handleDeleteFile,
    handleOptionalsChange,
  };
};
