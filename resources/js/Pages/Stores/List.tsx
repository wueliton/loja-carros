import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { Store } from '@/models/Store';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';

const storeHeader: THeadProps<Store>[] = [
  {
    key: 'name',
    title: 'Nome',
  },
  {
    key: 'store_number',
    title: 'Número',
  },
  {
    key: 'logo_url',
    title: 'logo',
    render: (data) => (
      <img
        src={`/storage/uploads/${data.logo_url}`}
        title={data.name}
        className="max-h-6 max-w-6"
      />
    ),
  },
  {
    key: 'email',
    title: 'E-mail',
  },
  {
    key: 'phone',
    title: 'Telefone',
  },
  {
    key: 'whatsapp',
    title: 'Whatsapp',
  },
];

export default function ListStorePage({
  stores,
  auth,
}: PageProps<{ stores: Store[] }>) {
  const { openDialog } = useDialog();

  const handleDelete = (item: Store) => {
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(route(Store.GET_ROUTE('delete'), { id: item.id }), {
          preserveScroll: true,
          onSuccess: () => {
            console.log('excluído com sucesso');
          },
        });
      },
    });
  };

  return (
    <AuthenticatedLayout
      user={auth.user}
      head={
        <Head title="Lojas">
          <Button
            onClick={() => router.visit(route(Store.GET_ROUTE('create')))}
          >
            Adicionar
          </Button>
        </Head>
      }
    >
      <Table
        data={stores}
        headers={storeHeader}
        onDelete={(item) => handleDelete(item)}
        onEdit={(item) =>
          router.visit(route(Store.GET_ROUTE('edit'), { id: item.id }))
        }
      />
    </AuthenticatedLayout>
  );
}
