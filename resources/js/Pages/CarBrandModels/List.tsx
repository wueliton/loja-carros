import { Button } from '@/Components/Button';
import { Filter } from '@/Components/Filter';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { ToggleTab, ToggleTabs } from '@/Components/ToggleTabs';
import { useDialog } from '@/Context/Dialog';
import { useUser } from '@/Context/User';
import { CarBrandModel } from '@/models/BrandModels';
import { Paginated } from '@/models/Paginated';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';
import { PutBrandModelModal } from './PutCarBrandModelModal';

const brandModelsHeader: THeadProps<CarBrandModel>[] = [
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
  auth,
}: PageProps<{ models: Paginated<CarBrandModel> }>) {
  const { openDialog } = useDialog();
  const { hasRole } = useUser();

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
            onSuccess: () => {},
          },
        );
      },
    });

  return (
    <>
      <Head title="Modelos">
        <Button onClick={() => handlePutBrandModel()}>Adicionar</Button>
      </Head>

      <Filter searchProperties={['name']}>
        <ToggleTabs fieldName="showAll">
          <ToggleTab>Todos os modelos</ToggleTab>
          <ToggleTab value={false}>Meus modelos</ToggleTab>
        </ToggleTabs>
      </Filter>
      <Table
        data={models}
        headers={brandModelsHeader}
        onEdit={(brandModel) => handlePutBrandModel(brandModel)}
        onDelete={handleDeleteBrandModel}
        canDelete={(item) =>
          hasRole('admin') || item.created_by === auth.user.id
        }
        canEdit={(item) => hasRole('admin') || item.created_by === auth.user.id}
      />
    </>
  );
}
