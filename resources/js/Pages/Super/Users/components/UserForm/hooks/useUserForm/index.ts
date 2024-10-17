import { useDiscardUnsaved } from '@/Hooks/useDiscardUnsaved';
import { useForm } from '@inertiajs/react';
import { FormEvent } from 'react';
import { UseUserFormProps } from './types';

export const useUserForm = ({ user, url }: UseUserFormProps) => {
  const { data, setData, errors, isDirty, post } = useForm<{
    name?: string;
    email?: string;
    password?: string;
    role?: (number | string)[];
  }>({
    name: '',
    email: '',
    password: '',
    role: [],
    ...(user
      ? {
          ...user,
          role: user.roles.map((role) => role.id),
        }
      : {}),
  });

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    if (user) {
      post(route(url, { id: user.id }));
      return;
    }

    post(route(url));
  };

  useDiscardUnsaved(isDirty);

  return {
    handleSubmit,
    data,
    setData,
    errors,
  };
};
