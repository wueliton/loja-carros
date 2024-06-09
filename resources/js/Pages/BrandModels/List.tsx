import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { BrandModel } from '@/models/BrandModels';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';
import { PutBrandModelModal } from './PutBrandModelModal';

const brandModelsHeader: THeadProps<BrandModel>[] = [
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
  auth,
  models,
}: PageProps<{ models: BrandModel[] }>) {
  const { openDialog } = useDialog();

  const handlePutBrandModel = (brandModel?: BrandModel) =>
    openDialog({
      component: PutBrandModelModal,
      props: {
        brandModel,
      },
    });

  const handleDeleteBrandModel = (brandModel: BrandModel) =>
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(route('brandModels.delete', { id: brandModel.id }), {
          preserveScroll: true,
          onSuccess: () => {
            console.log('excluído com sucesso');
          },
        });
      },
    });

  return (
    <AuthenticatedLayout
      user={auth.user}
      head={
        <Head title="Modelos">
          <Button onClick={() => handlePutBrandModel()}>Adicionar</Button>
        </Head>
      }
    >
      <Table
        data={models}
        headers={brandModelsHeader}
        onEdit={(brandModel) => handlePutBrandModel(brandModel)}
        onDelete={handleDeleteBrandModel}
      />
    </AuthenticatedLayout>
  );
}
