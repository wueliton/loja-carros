import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { CarOptional } from '@/models/VehicleOptional';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';
import { PutOptionalModal } from './PutCarOptionalModal';

const OptionalHeader: THeadProps<CarOptional>[] = [
  {
    key: 'name',
    title: 'Nome',
  },
];

export default function ListOptionalPage({
  auth,
  optional,
}: PageProps<{ optional: CarOptional[] }>) {
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
    <AuthenticatedLayout
      user={auth.user}
      head={
        <Head title="Opcionais">
          <Button onClick={() => handleAddFuelType()}>Adicionar</Button>
        </Head>
      }
    >
      <Table
        data={optional}
        headers={OptionalHeader}
        onEdit={(color) => handleAddFuelType(color)}
        onDelete={handleDeleteOptional}
      />
    </AuthenticatedLayout>
  );
}