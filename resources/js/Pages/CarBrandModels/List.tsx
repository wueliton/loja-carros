import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { CarBrandModel } from '@/models/BrandModels';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';
import { PutBrandModelModal } from './PutCarBrandModelModal';

const brandModelsHeader: THeadProps<CarBrandModel>[] = [
  {
    key: 'name',
    title: 'Tipo de Combustível',
  },
  {
    key: 'brand',
    title: 'Marca',
    render: (model) => <>{model.brand?.name}</>,
  },
];

export default function ListFuelTypesPage({
  models,
}: PageProps<{ models: CarBrandModel[] }>) {
  const { openDialog } = useDialog();

  const handlePutBrandModel = (brandModel?: CarBrandModel) =>
    openDialog({
      component: PutBrandModelModal,
      props: {
        brandModel,
      },
    });

  const handleDeleteBrandModel = (brandModel: CarBrandModel) =>
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(
          route(CarBrandModel.GET_ROUTE('delete'), { id: brandModel.id }),
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
      <Head title="Modelos">
        <Button onClick={() => handlePutBrandModel()}>Adicionar</Button>
      </Head>
      <Table
        data={models}
        headers={brandModelsHeader}
        onEdit={(brandModel) => handlePutBrandModel(brandModel)}
        onDelete={handleDeleteBrandModel}
      />
    </>
  );
}
