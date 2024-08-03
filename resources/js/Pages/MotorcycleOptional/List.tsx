import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { MotorcycleOptional } from '@/models/MotorcycleOptional';
import { Paginated } from '@/models/Paginated';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';
import { PutMotorcycleOptionalModal } from './PutMotorcycleOptionalModal';

const motorcycleOptionalHeader: THeadProps<MotorcycleOptional>[] = [
  {
    key: 'name',
    title: 'Opcional',
  },
];

export default function MotorcycleOptionalsPage({
  optionals,
}: PageProps<{ optionals: Paginated<MotorcycleOptional> }>) {
  const { openDialog } = useDialog();

  const handlePutOptional = (optional?: MotorcycleOptional) =>
    openDialog({
      component: PutMotorcycleOptionalModal,
      props: {
        optional,
      },
    });

  const handleDeleteOptional = (optional: MotorcycleOptional) =>
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(
          route(MotorcycleOptional.GET_ROUTE('delete'), {
            id: optional.id,
          }),
          {
            preserveScroll: true,
          },
        );
      },
    });

  return (
    <>
      <Head title="Opcionais">
        <Button onClick={() => handlePutOptional()}>Adicionar</Button>
      </Head>
      <Table
        data={optionals}
        headers={motorcycleOptionalHeader}
        onEdit={(optional) => handlePutOptional(optional)}
        onDelete={handleDeleteOptional}
      />
    </>
  );
}
