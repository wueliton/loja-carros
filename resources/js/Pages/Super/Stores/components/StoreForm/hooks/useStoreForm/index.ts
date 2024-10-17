import { useDiscardUnsaved } from '@/Hooks/useDiscardUnsaved';
import { useForm } from '@inertiajs/react';
import { FormEvent } from 'react';
import { StoreFormProps, UseStoreFormProps } from './types';

export const useStoreForm = ({ store, postUrl }: UseStoreFormProps) => {
  const { data, setData, errors, isDirty, post, transform } =
    useForm<StoreFormProps>({
      logo_url: undefined,
      name: '',
      store_number: '',
      email: '',
      users: [],
      ...(store
        ? {
            ...store,
            logo_url: undefined,
            users: store?.users_ids,
            phone: store?.phone,
            whatsapp: store?.whatsapp,
          }
        : {}),
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

    if (store) {
      post(route(postUrl, { id: store.id }));
      return;
    }

    post(route(postUrl));
  };

  useDiscardUnsaved(isDirty);

  return {
    data,
    setData,
    errors,
    handleSubmit,
  };
};
