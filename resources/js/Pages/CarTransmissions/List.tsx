import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { useDialog } from '@/Context/Dialog';
import { Transmission } from '@/models/Transmission';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';
import { PutTransmissionModal } from './PutCarTransmissionModal';

const TransmissionsHeader: THeadProps<Transmission>[] = [
  {
    key: 'name',
    title: 'Tipo de Câmbio',
  },
];

export default function ListTransmissionsPage({
  transmissions,
}: PageProps<{ transmissions: Transmission[] }>) {
  const { openDialog } = useDialog();

  const handleAddFuelType = (transmission?: Transmission) =>
    openDialog({
      component: PutTransmissionModal,
      props: {
        transmission,
      },
    });

  const handleDeleteFuelType = (transmission: Transmission) =>
    openDialog({
      content: {
        title: 'Deseja excluir?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;
        router.delete(
          route(Transmission.GET_ROUTE('delete'), { id: transmission.id }),
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
      <Head title="Tipos de Câmbios">
        <Button onClick={() => handleAddFuelType()}>Adicionar</Button>
      </Head>
      <Table
        data={transmissions}
        headers={TransmissionsHeader}
        onEdit={(color) => handleAddFuelType(color)}
        onDelete={handleDeleteFuelType}
      />
    </>
  );
}
