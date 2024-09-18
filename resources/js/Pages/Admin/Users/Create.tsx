import { Button } from '@/Components/Button';
import { Card } from '@/Components/Card';
import { Input } from '@/Components/Forms/Input';
import { Select } from '@/Components/Forms/Select';
import { Head } from '@/Components/Head';
import { useDiscardUnsaved } from '@/Hooks/useDiscardUnsaved';
import { AdminRouter } from '@/Routes/app.router';
import { Role } from '@/models/Role';
import { PageProps } from '@/types';
import { useForm } from '@inertiajs/react';
import { FormEvent } from 'react';

export default function CreateUserPage({
  roles,
}: PageProps<{ roles: Role[] }>) {
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
  });

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    post(route('users.create'));
  };

  useDiscardUnsaved(isDirty);

  return (
    <>
      <Head
        title="Adicionar Usuário"
        breadcrumb={[{ title: 'Usuários', url: route(AdminRouter.USERS) }]}
      />
      <Card>
        <form
          onSubmit={handleSubmit}
          className="grid grid-cols-1 md:grid-cols-2 gap-3"
        >
          <Input
            label="Nome"
            value={data.name}
            error={errors.name}
            onChange={(e) => setData('name', e.target.value)}
            className="md:col-span-2"
          />
          <Input
            label="E-mail"
            value={data.email}
            error={errors.email}
            onChange={(e) => setData('email', e.target.value)}
          />
          <Input
            label="Senha"
            value={data.password}
            error={errors.password}
            type="password"
            onChange={(e) => setData('password', e.target.value)}
          ></Input>
          <Select
            label="Perfil"
            options={roles}
            value={data.role}
            propertyToDisplay="name"
            propertyValue="id"
            error={errors.role}
            onChange={(values) => setData('role', values)}
          />
          <div className="flex justify-end md:col-span-2">
            <Button>Salvar</Button>
          </div>
        </form>
      </Card>
    </>
  );
}
