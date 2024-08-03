import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { Car } from '@/models/Car';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';
import moment from 'moment';
import { Tooltip } from 'react-tooltip';

const carHeader: THeadProps<Car>[] = [
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

export default function ListVehiclesPage({ cars }: PageProps<{ cars: Car[] }>) {
  const { openDialog } = useDialog();
  const handleDelete = (car: Car) =>
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(route(Car.GET_ROUTE('delete'), { id: car.id }), {
          preserveScroll: true,
        });
      },
    });

  return (
    <>
      <>
        <Head title="Carros">
          <Button
            onClick={() =>
              router.visit(route(Car.GET_ROUTE('createView')), {
                preserveScroll: true,
              })
            }
          >
            Adicionar
          </Button>
        </Head>
        <Table
          data={cars}
          headers={carHeader}
          onDelete={handleDelete}
          onEdit={(item) =>
            router.visit(route(Car.GET_ROUTE('get'), { id: item.id }), {
              preserveScroll: true,
            })
          }
        />
      </>
      <Tooltip id="created_at" />
    </>
  );
}
