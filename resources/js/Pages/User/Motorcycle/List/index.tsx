import { Button } from '@/Components/Button';
import { Filter } from '@/Components/Filter';
import { Chip } from '@/Components/Forms/Chip';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { UserRoutes } from '@/constants';
import { Motorcycle } from '@/models/Motorcycle';
import { Paginated } from '@/models/Paginated';
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

export default function MotorcyclePage({
  motorcycles,
  canCreate,
}: PageProps<{ motorcycles: Paginated<Motorcycle>; canCreate: boolean }>) {
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
        router.delete(route(UserRoutes.MOTO_DELETE, { id: motorcycle.id }), {
          preserveScroll: true,
        });
      },
    });

  return (
    <>
      <Head title="Motos">
        <Button
          onClick={() =>
            router.visit(route(UserRoutes.MOTO_CREATE_VIEW), {
              preserveScroll: true,
            })
          }
          disabled={!canCreate}
          {...(canCreate
            ? {}
            : {
                'data-tooltip-id': 'created_at',
                'data-tooltip-content': 'Você atingiu o limite de cadastros',
              })}
        >
          Adicionar
        </Button>
      </Head>

      <Filter searchProperties={['title', 'brand.name', 'model.name']} />
      <Table
        data={motorcycles}
        headers={motorcycleHeader}
        onDelete={handleDeleteMotorcycle}
        onEdit={(item) =>
          router.visit(route(UserRoutes.MOTO_EDIT_VIEW, { id: item.id }), {
            preserveScroll: true,
          })
        }
      />
      <Tooltip id="created_at" />
    </>
  );
}
