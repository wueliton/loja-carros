import { Button } from '@/Components/Button';
import { Filter } from '@/Components/Filter';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { ToggleTab, ToggleTabs } from '@/Components/ToggleTabs';
import { useDialog } from '@/Context/Dialog';
import { useUser } from '@/Context/User';
import { AdminRoutes } from '@/constants';
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
  auth,
}: PageProps<{ models: Paginated<MotorcycleBrandModels> }>) {
  const { openDialog } = useDialog();
  const { hasRole } = useUser();

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
          route(AdminRoutes.MOTO_MODELS_DELETE, {
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

      <Filter searchProperties={['name']}>
        <ToggleTabs fieldName="showAll">
          <ToggleTab>Todos os tipos</ToggleTab>
          <ToggleTab value={false}>Meus tipos</ToggleTab>
        </ToggleTabs>
      </Filter>
      <Table
        data={models}
        headers={motorcycleBrandModelsHeader}
        onEdit={(brandModel) => handlePutBrandModel(brandModel)}
        onDelete={handleDeleteBrandModel}
        canDelete={(item) =>
          hasRole('super') || item.created_by === auth.user.id
        }
        canEdit={(item) => hasRole('super') || item.created_by === auth.user.id}
      />
    </>
  );
}
