import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { MotorcycleBrandModels } from '@/models/MotorcycleBrandModels';
import { Paginated } from '@/models/Paginated';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';
import { PutMotorcycleBrandModelModal } from './PutMotorcycleBrandModelModal';

const motorcycleBrandModelsHeader: THeadProps<MotorcycleBrandModels>[] = [
  {
    key: 'name',
    title: 'Modelo',
  },
  {
    key: 'brand',
    title: 'Marca',
    render: (model) => <>{model.brand?.name}</>,
  },
];

export default function ListFuelTypesPage({
  models,
}: PageProps<{ models: Paginated<MotorcycleBrandModels> }>) {
  const { openDialog } = useDialog();

  const handlePutBrandModel = (brandModel?: MotorcycleBrandModels) =>
    openDialog({
      component: PutMotorcycleBrandModelModal,
      props: {
        brandModel,
      },
    });

  const handleDeleteBrandModel = (brandModel: MotorcycleBrandModels) =>
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(
          route(MotorcycleBrandModels.GET_ROUTE('delete'), {
            id: brandModel.id,
          }),
          {
            preserveScroll: true,
          },
        );
      },
    });

  return (
    <>
      <Head title="Modelos">
        <Button onClick={() => handlePutBrandModel()}>Adicionar</Button>
      </Head>
      <Table
        data={models}
        headers={motorcycleBrandModelsHeader}
        onEdit={(brandModel) => handlePutBrandModel(brandModel)}
        onDelete={handleDeleteBrandModel}
      />
    </>
  );
}
