import { Button } from '@/Components/Button';
import { Filter } from '@/Components/Filter';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { ToggleTab, ToggleTabs } from '@/Components/ToggleTabs';
import { useDialog } from '@/Context/Dialog';
import { useUser } from '@/Context/User';
import { Brand } from '@/models/Brand';
import { Paginated } from '@/models/Paginated';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';
import { PutBrandModal } from './PutBrandModal';

const brandsHeader: THeadProps<Brand>[] = [
  {
    key: 'name',
    title: 'Marca',
  },
];

export default function ListFuelTypesPage({
  brands,
  auth,
}: PageProps<{ brands: Paginated<Brand> }>) {
  const { openDialog } = useDialog();
  const { hasRole } = useUser();

  const handlePutBrand = (brand?: Brand) =>
    openDialog({
      component: PutBrandModal,
      props: {
        brand,
      },
    });

  const handleDeleteBrand = (brand: Brand) =>
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(route(Brand.GET_ROUTE('delete'), { id: brand.id }), {
          preserveScroll: true,
          onSuccess: () => {
            router.reload();
          },
        });
      },
    });

  return (
    <>
      <Head title="Marcas">
        <Button onClick={() => handlePutBrand()}>Adicionar</Button>
      </Head>

      <Filter searchProperties={['name']}>
        <ToggleTabs fieldName="showAll">
          <ToggleTab>Todas as marcas</ToggleTab>
          <ToggleTab value={false}>Minhas marcas</ToggleTab>
        </ToggleTabs>
      </Filter>
      <Table
        data={brands}
        headers={brandsHeader}
        onEdit={(color) => handlePutBrand(color)}
        onDelete={handleDeleteBrand}
        canDelete={(item) =>
          hasRole('admin') || item.created_by === auth.user.id
        }
        canEdit={(item) => hasRole('admin') || item.created_by === auth.user.id}
      />
    </>
  );
}
