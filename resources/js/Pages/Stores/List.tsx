import { Button } from '@/Components/Button';
import { Filter } from '@/Components/Filter';
import { HasRole } from '@/Components/HasRole';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { useUser } from '@/Context/User';
import { Paginated } from '@/models/Paginated';
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
        src={`storage/uploads/${data.logo_url}`}
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
}: PageProps<{ stores: Paginated<Store> }>) {
  const { openDialog } = useDialog();
  const { hasRole } = useUser();

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
          onSuccess: () => {},
        });
      },
    });
  };

  return (
    <>
      <Head title="Lojas">
        <HasRole role="admin">
          <Button
            onClick={() =>
              router.visit(route(Store.GET_ROUTE('create')), {
                preserveScroll: true,
              })
            }
          >
            Adicionar
          </Button>
        </HasRole>
      </Head>

      <Filter searchProperties={['name']} />
      <Table
        data={stores}
        headers={storeHeader}
        onDelete={hasRole('admin') ? (item) => handleDelete(item) : undefined}
        onEdit={(item) =>
          router.visit(route(Store.GET_ROUTE('edit'), { id: item.id }), {
            preserveScroll: true,
          })
        }
      />
    </>
  );
}
