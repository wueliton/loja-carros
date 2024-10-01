import { TrashIcon } from '@/Components/Icons/Trash';
import { useDialog } from '@/Context/Dialog';
import { useCarService } from '@/Hooks/useCarService';
import { useCommonService } from '@/Hooks/useCommonService';
import { Car } from '@/models/Car';
import { useForm } from '@inertiajs/react';
import axios from 'axios';
import { FormEvent, useMemo, useState } from 'react';
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
  const commonService = useCommonService();
  const carService = useCarService();

  const { data, setData, errors, post, isDirty } = useForm<CarFormSchema>({
    year: currentYear,
    manufacturingYear: currentYear,
    optionals: [],
    transmission: undefined,
    ...defaultValues,
  });

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    post(postUrl);
  };

  const handleCreateModel = (search: string) => {
    return carService.createModel(search, data.brand!);
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
          .delete(route('api.cars.images.delete', { id }))
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
    errors,
    post,
    isDirty,
    onSubmit: handleSubmit,
    commonService,
    selectedFiles,
    carService,
    currentYear,
    handleCreateModel,
    handleDeleteFile,
  };
};
