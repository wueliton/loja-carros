import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { Paginated } from '@/models/Paginated';
import { CarOptional } from '@/models/VehicleOptional';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';
import { PutOptionalModal } from './PutCarOptionalModal';

const OptionalHeader: THeadProps<CarOptional>[] = [
  {
    key: 'name',
    title: 'Opcional',
  },
];

export default function ListOptionalPage({
  optional,
}: PageProps<{ optional: Paginated<CarOptional> }>) {
  const { openDialog } = useDialog();

  const handleAddFuelType = (optional?: CarOptional) =>
    openDialog({
      component: PutOptionalModal,
      props: {
        optional: optional,
      },
    });

  const handleDeleteOptional = (optional: CarOptional) =>
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(
          route(CarOptional.GET_ROUTE('delete'), { id: optional.id }),
          {
            preserveScroll: true,
          },
        );
      },
    });

  return (
    <>
      <Head title="Opcionais">
        <Button onClick={() => handleAddFuelType()}>Adicionar</Button>
      </Head>
      <Table
        data={optional}
        headers={OptionalHeader}
        onEdit={(color) => handleAddFuelType(color)}
        onDelete={handleDeleteOptional}
      />
    </>
  );
}
