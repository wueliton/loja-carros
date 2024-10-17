import { Button } from '@/Components/Button';
import { Filter } from '@/Components/Filter';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { ToggleTab, ToggleTabs } from '@/Components/ToggleTabs';
import { useDialog } from '@/Context/Dialog';
import { useUser } from '@/Context/User';
import { AdminRoutes } from '@/constants';
import { MotorcycleTypes } from '@/models/MotorcycleTypes';
import { Paginated } from '@/models/Paginated';
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
  types,
  auth,
}: PageProps<{ types: Paginated<MotorcycleTypes> }>) {
  const { openDialog } = useDialog();
  const { hasRole } = useUser();

  const handlePutType = (type?: MotorcycleTypes) =>
    openDialog({
      component: PutMotorcycleTypeModal,
      props: {
        type,
      },
    });

  const handleDeleteType = (type: MotorcycleTypes) =>
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(
          route(AdminRoutes.MOTO_TYPES_DELETE, {
            id: type.id,
          }),
          {
            preserveScroll: true,
          },
        );
      },
    });

  return (
    <>
      <Head title="Tipos">
        <Button onClick={() => handlePutType()}>Adicionar</Button>
      </Head>

      <Filter searchProperties={['name']}>
        <ToggleTabs fieldName="showAll">
          <ToggleTab>Todos os tipos</ToggleTab>
          <ToggleTab value={false}>Meus tipos</ToggleTab>
        </ToggleTabs>
      </Filter>
      <Table
        data={types}
        headers={motorcycleTypesHeader}
        onEdit={(type) => handlePutType(type)}
        onDelete={handleDeleteType}
        canDelete={(item) =>
          hasRole('super') || item.created_by === auth.user.id
        }
        canEdit={(item) => hasRole('super') || item.created_by === auth.user.id}
      />
    </>
  );
}
