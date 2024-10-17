import { Card } from '@/Components/Card';
import { Head } from '@/Components/Head';
import { SuperRoutes } from '@/constants';
import { Role } from '@/models/Role';
import { UserForm } from './components/UserForm';

export default function CreateUserPage({ roles }: { roles: Role[] }) {
  return (
    <>
      <Head
        title="Adicionar Usuário"
        breadcrumb={[
          { title: 'Usuários', url: route(SuperRoutes.USERS_LIST_VIEW) },
        ]}
      />
      <Card>
        <UserForm url={SuperRoutes.USERS_CREATE} roles={roles} />
      </Card>
    </>
  );
}
