import { Button } from '@/Components/Button';
import { Filter } from '@/Components/Filter';
import { Chip } from '@/Components/Forms/Chip';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { AdminRouter } from '@/Routes/app.router';
import { Paginated } from '@/models/Paginated';
import { PageProps, User } from '@/types';
import { router } from '@inertiajs/react';

const usersHeader: THeadProps<User>[] = [
  {
    key: 'name',
    title: 'Nome',
  },
  {
    key: 'email',
    title: 'E-mail',
  },
  {
    key: 'roles',
    title: 'Perfil',
    render: (data) => (
      <>
        {data.roles.map((role, index) => (
          <Chip key={`${data.id}-role-${index}`}>{role.name}</Chip>
        ))}
      </>
    ),
  },
];

export default function AdminListUserPage({
  users,
}: PageProps<{ users: Paginated<User> }>) {
  const { openDialog } = useDialog();

  console.log(route());

  const handleDelete = (item: User) => {
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(route(AdminRouter.REQ_DELETE_USER, { id: item.id }), {
          preserveScroll: true,
          onSuccess: () => {},
        });
      },
    });
  };

  return (
    <>
      <Head title="Usuários">
        <Button
          onClick={() =>
            router.visit(route(AdminRouter.NEW_USER), { preserveScroll: true })
          }
        >
          Adicionar
        </Button>
      </Head>

      <Filter searchProperties={['name', 'email']} />
      <Table
        data={users}
        headers={usersHeader}
        onDelete={handleDelete}
        onEdit={(item) => {
          router.visit(route(AdminRouter.EDIT_USER, { id: item.id }), {
            preserveScroll: true,
          });
        }}
      />
    </>
  );
}
