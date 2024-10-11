import { TrashIcon } from '@/Components/Icons/Trash';
import { useDialog } from '@/Context/Dialog';
import { useCommonService } from '@/Hooks/useCommonService';
import { useMotorcycleService } from '@/Hooks/useMotorcycleService';
import { APIRoutes } from '@/constants';
import { Motorcycle } from '@/models/Motorcycle';
import { useForm } from '@inertiajs/react';
import axios from 'axios';
import { FormEvent, useMemo, useState } from 'react';
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

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    post(postUrl);
  };

  const handleCreateModel = (search: string) => {
    return motorcycleService.createModel(search, data.brand!);
  };

  const handleDeleteFile = (id?: number) => {
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
            setCurrentFiles((prev) => prev?.filter((img) => img.id !== id)),
          );
      },
    });
  };

  const selectedFiles = useMemo(
    () =>
      currentFiles?.map((file) => ({
        ...file,
        fileName: file.url,
      })),
    [currentFiles],
  );

  return {
    data,
    setData,
    ...form,
    commonService,
    selectedFiles,
    currentYear,
    motorcycleService,
    onSubmit: handleSubmit,
    handleCreateModel,
    handleDeleteFile,
  };
};
