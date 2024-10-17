import { Card } from '@/Components/Card';
import { Head } from '@/Components/Head';
import { SuperRoutes } from '@/constants';
import { Role } from '@/models/Role';
import { User } from '@/types';
import { UserForm } from './components/UserForm';

export default function EditUserPage({
  user,
  roles,
}: {
  user: User;
  roles: Role[];
}) {
  return (
    <>
      <Head
        title="Adicionar Usuário"
        breadcrumb={[
          { title: 'Usuários', url: route(SuperRoutes.USERS_LIST_VIEW) },
        ]}
      />
      <Card>
        <UserForm url={SuperRoutes.USERS_EDIT} roles={roles} user={user} />
      </Card>
    </>
  );
}
