import { Button } from '@/Components/Button';
import { Filter } from '@/Components/Filter';
import { Chip } from '@/Components/Forms/Chip';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { UserRoutes } from '@/constants';
import { Car } from '@/models/Car';
import { Paginated } from '@/models/Paginated';
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
    key: 'store',
    title: 'Loja',
    render: (data) => <Chip canRemove={false}>{data.store?.name}</Chip>,
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

export default function ListVehiclesPage({
  cars,
}: PageProps<{ cars: Paginated<Car> }>) {
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
        router.delete(route(UserRoutes.CAR_DELETE, { id: car.id }), {
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
              router.visit(route(UserRoutes.CAR_CREATE_VIEW), {
                preserveScroll: true,
              })
            }
          >
            Adicionar
          </Button>
        </Head>
        <Filter
          searchProperties={['title', 'brand.name', 'model.name']}
        ></Filter>
        <Table
          data={cars}
          headers={carHeader}
          onDelete={handleDelete}
          onEdit={(item) =>
            router.visit(route(UserRoutes.CAR_EDIT_VIEW, { id: item.id }), {
              preserveScroll: true,
            })
          }
        />
      </>
      <Tooltip id="created_at" />
    </>
  );
}
