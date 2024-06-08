import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { Color } from '@/models/Color';
import { PageProps } from '@/types';
import { AddColorModal } from './AddColorModal';

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
      component: AddColorModal,
      props: {
        color,
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
      />
    </AuthenticatedLayout>
  );
}
