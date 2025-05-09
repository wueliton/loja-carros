import { Button } from '@/Components/Button';
import { Filter } from '@/Components/Filter';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { SuperRoutes } from '@/constants';
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

  const handleDelete = (item: Store) => {
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(route(SuperRoutes.STORE_DELETE, { id: item.id }), {
          preserveScroll: true,
          onSuccess: () => {},
        });
      },
    });
  };

  return (
    <>
      <Head title="Lojas">
        <Button
          onClick={() =>
            router.visit(route(SuperRoutes.STORE_CREATE_VIEW), {
              preserveScroll: true,
            })
          }
        >
          Adicionar
        </Button>
      </Head>

      <Filter searchProperties={['name']} />
      <Table
        data={stores}
        headers={storeHeader}
        onDelete={(item) => handleDelete(item)}
        onEdit={(item) =>
          router.visit(route(SuperRoutes.STORE_EDIT_VIEW, { id: item.id }), {
            preserveScroll: true,
          })
        }
      />
    </>
  );
}
