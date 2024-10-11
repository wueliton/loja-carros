import { Button } from '@/Components/Button';
import { Filter } from '@/Components/Filter';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { ToggleTab, ToggleTabs } from '@/Components/ToggleTabs';
import { useDialog } from '@/Context/Dialog';
import { useUser } from '@/Context/User';
import { AdminRoutes } from '@/constants';
import { Color } from '@/models/Color';
import { Paginated } from '@/models/Paginated';
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
  colors,
  auth,
}: PageProps<{ colors: Paginated<Color> }>) {
  const { openDialog } = useDialog();
  const { hasRole } = useUser();

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
        router.delete(route(AdminRoutes.COLORS_DELETE, { id: color.id }), {
          preserveScroll: true,
          onSuccess: () => {},
        });
      },
    });

  return (
    <>
      <Head title="Cores">
        <Button onClick={() => handleAddColor()}>Adicionar</Button>
      </Head>

      <Filter searchProperties={['color']}>
        <ToggleTabs fieldName="showAll">
          <ToggleTab>Todas as cores</ToggleTab>
          <ToggleTab value={false}>Minhas cores</ToggleTab>
        </ToggleTabs>
      </Filter>
      <Table
        data={colors}
        headers={colorsHeader}
        onEdit={(color) => handleAddColor(color)}
        onDelete={handleDeleteColor}
        canDelete={(item) =>
          hasRole('admin') || item.created_by === auth.user.id
        }
        canEdit={(item) => hasRole('admin') || item.created_by === auth.user.id}
      />
    </>
  );
}
