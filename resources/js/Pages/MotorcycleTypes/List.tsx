import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { MotorcycleTypes } from '@/models/MotorcycleTypes';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';
import { PutMotorcycleTypeModal } from './PutMotorcycleTypesModal';

const motorcycleTypesHeader: THeadProps<MotorcycleTypes>[] = [
  {
    key: 'name',
    title: 'Tipo',
  },
];

export default function MotorcycleTypesPage({
  auth,
  types,
}: PageProps<{ types: MotorcycleTypes[] }>) {
  const { openDialog } = useDialog();

  const handlePutType = (optional?: MotorcycleTypes) =>
    openDialog({
      component: PutMotorcycleTypeModal,
      props: {
        optional,
      },
    });

  const handleDeleteType = (optional: MotorcycleTypes) =>
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(
          route(MotorcycleTypes.GET_ROUTE('delete'), {
            id: optional.id,
          }),
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
        <Head title="Tipos">
          <Button onClick={() => handlePutType()}>Adicionar</Button>
        </Head>
      }
    >
      <Table
        data={types}
        headers={motorcycleTypesHeader}
        onEdit={(optional) => handlePutType(optional)}
        onDelete={handleDeleteType}
      />
    </AuthenticatedLayout>
  );
}
