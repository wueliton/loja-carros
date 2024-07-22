import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { Color } from '@/models/Color';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';
import { PutColorModal } from './PutColorModal';

const colorsHeader: THeadProps<Color>[] = [
  {
    key: 'color',
    title: 'Cor',
  },
];

export default function ListColorsPage({
  auth,
  colors,
}: PageProps<{ colors: Color[] }>) {
  const { openDialog } = useDialog();

  const handleAddColor = (color?: Color) =>
    openDialog({
      component: PutColorModal,
      props: {
        color,
      },
    });

  const handleDeleteColor = (color: Color) =>
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(route(Color.GET_ROUTE('delete'), { id: color.id }), {
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
        <Head title="Cores">
          <Button onClick={() => handleAddColor()}>Adicionar</Button>
        </Head>
      }
    >
      <Table
        data={colors}
        headers={colorsHeader}
        onEdit={(color) => handleAddColor(color)}
        onDelete={handleDeleteColor}
      />
    </AuthenticatedLayout>
  );
}
