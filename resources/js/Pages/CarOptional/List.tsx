import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { VehicleOptional } from '@/models/VehicleOptional';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';
import { PutOptionalModal } from './PutCarOptionalModal';

const OptionalHeader: THeadProps<VehicleOptional>[] = [
  {
    key: 'name',
    title: 'Nome',
  },
];

export default function ListOptionalPage({
  auth,
  optional,
}: PageProps<{ optional: VehicleOptional[] }>) {
  const { openDialog } = useDialog();

  const handleAddFuelType = (optional?: VehicleOptional) =>
    openDialog({
      component: PutOptionalModal,
      props: {
        optional: optional,
      },
    });

  const handleDeleteOptional = (optional: VehicleOptional) =>
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(
          route(VehicleOptional.GET_ROUTE('delete'), { id: optional.id }),
          {
            preserveScroll: true,
            onSuccess: () => {
              console.log('excluído com sucesso');
            },
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
