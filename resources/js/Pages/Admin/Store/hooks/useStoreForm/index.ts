import { Store } from '@/models/Store';
import { router, useForm } from '@inertiajs/react';
import { FormEvent } from 'react';
import { UseStoreFormProps } from './types';

export const useStoreForm = ({ store, postRoute }: UseStoreFormProps) => {
  const { post, transform, ...form } = useForm<
    Omit<Store, 'logo_url' | 'phone' | 'whatsapp'> & {
      phone?: string | number;
      whatsapp?: string | number;
      logo_url?: File;
      users: number[];
    }
  >({
    ...store,
    logo_url: undefined,
    users: store.users_ids,
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
    post(postRoute, {
      onSuccess: () => {
        router.reload();
      },
    });
  };

  return {
    ...form,
    handleSubmit,
  };
};
