import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { Motorcycle } from '@/models/Motorcycle';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';
import moment from 'moment';
import { Tooltip } from 'react-tooltip';

const motorcycleHeader: THeadProps<Motorcycle>[] = [
  {
    key: 'title',
    title: 'Título Anuncio',
  },
  {
    key: 'brand',
    title: 'Marca',
    render: (data) => <>{data.brand?.name}</>,
  },
  {
    key: 'model',
    title: 'Modelo',
    render: (data) => <>{data.model?.name}</>,
  },
  {
    key: 'created_at',
    title: 'Data de Criação',
    render: (data) => (
      <>
        <span
          data-tooltip-id="created_at"
          data-tooltip-content={moment(data.created_at).format(
            'DD/MM/YYYY HH:mm:ss',
          )}
        >
          {moment.duration(moment().diff(data.created_at)).humanize()}
        </span>
      </>
    ),
  },
];

export default function MotorcyclePage({
  auth,
  motorcycles,
}: PageProps<{ motorcycles: Motorcycle[] }>) {
  const { openDialog } = useDialog();

  const handleDeleteMotorcycle = (motorcycle: Motorcycle) =>
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(
          route(Motorcycle.GET_ROUTE('delete'), { id: motorcycle.id }),
          {
            preserveScroll: true,
          },
        );
      },
    });

  return (
    <>
      <AuthenticatedLayout
        user={auth.user}
        head={
          <Head title="Motos">
            <Button
              onClick={() =>
                router.visit(route(Motorcycle.GET_ROUTE('createView')))
              }
            >
              Adicionar
            </Button>
          </Head>
        }
      >
        <Table
          data={motorcycles}
          headers={motorcycleHeader}
          onDelete={handleDeleteMotorcycle}
          onEdit={(item) =>
            router.visit(route(Motorcycle.GET_ROUTE('get'), { id: item.id }))
          }
        />
      </AuthenticatedLayout>
      <Tooltip id="created_at" />
    </>
  );
}