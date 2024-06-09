import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { Brand } from '@/models/Brand';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';
import { PutBrandModal } from './PutBrandModal';

const brandsHeader: THeadProps<Brand>[] = [
  {
    key: 'name',
    title: 'Tipo de Combustível',
  },
];

export default function ListFuelTypesPage({
  auth,
  brands,
}: PageProps<{ brands: Brand[] }>) {
  const { openDialog } = useDialog();

  const handlePutBrand = (fuelType?: Brand) =>
    openDialog({
      component: PutBrandModal,
      props: {
        fuelType,
      },
    });

  const handleDeleteBrand = (fuelType: Brand) =>
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(route('brands.delete', { id: fuelType.id }), {
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
        <Head title="Marcas">
          <Button onClick={() => handlePutBrand()}>Adicionar</Button>
        </Head>
      }
    >
      <Table
        data={brands}
        headers={brandsHeader}
        onEdit={(color) => handlePutBrand(color)}
        onDelete={handleDeleteBrand}
      />
    </AuthenticatedLayout>
  );
}
