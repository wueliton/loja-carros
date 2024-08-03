import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { FuelType } from '@/models/FuelType';
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
}: PageProps<{ fuelTypes: FuelType[] }>) {
  const { openDialog } = useDialog();

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
          route(FuelType.GET_ROUTE('delete'), { id: fuelType.id }),
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
    <>
      <Head title="Tipos de Combustíveis">
        <Button onClick={() => handleAddFuelType()}>Adicionar</Button>
      </Head>
      <Table
        data={fuelTypes}
        headers={fuelTypesHeader}
        onEdit={(color) => handleAddFuelType(color)}
        onDelete={handleDeleteFuelType}
      />
    </>
  );
}
