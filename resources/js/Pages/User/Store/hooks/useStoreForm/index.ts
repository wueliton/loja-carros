import { UserRoutes } from '@/constants';
import { useForm } from '@inertiajs/react';
import { FormEvent, useState } from 'react';
import { StoreSchema, UseStoreFormProps } from './types';

export const useStoreForm = ({ store }: UseStoreFormProps) => {
  const [editState, setEditState] = useState(false);
  const { transform, post, ...form } = useForm<StoreSchema>({
    ...store,
    logo_url: undefined,
    phone: String(store.phone),
    whatsapp: String(store.whatsapp),
  });

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    transform((data) => ({
      ...data,
      phone: data.phone
        ? Number(String(data.phone)?.replace(/\D/g, ''))
        : undefined,
      whatsapp: data?.whatsapp
        ? Number(String(data.whatsapp)?.replace(/\D/g, ''))
        : undefined,
    }));
    e.preventDefault();
    post(route(UserRoutes.STORE_SUGGEST_CHANGE), {
      onFinish: () => {
        setEditState(false);
      },
    });
  };

  return {
    onSubmit: handleSubmit,
    ...form,
    editState,
    setEditState,
  };
};
