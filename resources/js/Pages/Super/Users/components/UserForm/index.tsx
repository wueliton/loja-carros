import { Button } from '@/Components/Button';
import { Input } from '@/Components/Forms/Input';
import { Select } from '@/Components/Forms/Select';
import { userRoles } from '@/constants';
import { useUserForm } from './hooks/useUserForm';
import { UserFormProps } from './types';

export const UserForm = ({ roles, url, user }: UserFormProps) => {
  const { handleSubmit, data, errors, setData } = useUserForm({
    url,
    user,
  });
  const mappedRoles = roles.map((role) => ({
    ...role,
    name: userRoles[role.name],
  }));

  return (
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
        options={mappedRoles}
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
  );
};
