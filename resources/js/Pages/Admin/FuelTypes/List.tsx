import { Button } from '@/Components/Button';
import { Filter } from '@/Components/Filter';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { ToggleTab, ToggleTabs } from '@/Components/ToggleTabs';
import { useDialog } from '@/Context/Dialog';
import { useUser } from '@/Context/User';
import { AdminRoutes } from '@/constants';
import { FuelType } from '@/models/FuelType';
import { Paginated } from '@/models/Paginated';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';
import { PutFuelTypeModal } from './PutFuelTypeModal';

const fuelTypesHeader: THeadProps<FuelType>[] = [
  {
    key: 'name',
    title: 'Tipo de Combustível',
  },
];

export default function ListFuelTypesPage({
  fuelTypes,
  auth,
}: PageProps<{ fuelTypes: Paginated<FuelType> }>) {
  const { openDialog } = useDialog();
  const { hasRole } = useUser();

  const handleAddFuelType = (fuelType?: FuelType) =>
    openDialog({
      component: PutFuelTypeModal,
      props: {
        fuelType,
      },
    });

  const handleDeleteFuelType = (fuelType: FuelType) =>
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(
          route(AdminRoutes.FUEL_TYPES_DELETE, { id: fuelType.id }),
          {
            preserveScroll: true,
            onSuccess: () => {},
          },
        );
      },
    });

  return (
    <>
      <Head title="Tipos de Combustíveis">
        <Button onClick={() => handleAddFuelType()}>Adicionar</Button>
      </Head>
      <Filter searchProperties={['name']}>
        <ToggleTabs fieldName="showAll">
          <ToggleTab>Todas os tipos</ToggleTab>
          <ToggleTab value={false}>Meus tipos</ToggleTab>
        </ToggleTabs>
      </Filter>
      <Table
        data={fuelTypes}
        headers={fuelTypesHeader}
        onEdit={(color) => handleAddFuelType(color)}
        onDelete={handleDeleteFuelType}
        canDelete={(item) =>
          hasRole('admin') || item.created_by === auth.user.id
        }
        canEdit={(item) => hasRole('admin') || item.created_by === auth.user.id}
      />
    </>
  );
}
