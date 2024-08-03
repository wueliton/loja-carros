import { Button } from '@/Components/Button';
import { Chip } from '@/Components/Forms/Chip';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
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

export default function ListUserPage({ users }: PageProps<{ users: User[] }>) {
  const { openDialog } = useDialog();

  const handleDelete = (item: User) => {
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(route('users.delete', { id: item.id }), {
          preserveScroll: true,
          onSuccess: () => {
            console.log('excluído com sucesso');
          },
        });
      },
    });
  };

  return (
    <>
      <Head title="Usuários">
        <Button
          onClick={() =>
            router.visit(route('users.createView'), { preserveScroll: true })
          }
        >
          Adicionar
        </Button>
      </Head>
      <Table
        data={users}
        headers={usersHeader}
        onDelete={handleDelete}
        onEdit={(item) =>
          router.visit(route('users.get', { id: item.id }), {
            preserveScroll: true,
          })
        }
      />
    </>
  );
}
