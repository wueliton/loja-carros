import { Button } from '@/Components/Button';
import { Filter } from '@/Components/Filter';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { THeadProps, Table } from '@/Components/Table';
import { ToggleTab, ToggleTabs } from '@/Components/ToggleTabs';
import { useDialog } from '@/Context/Dialog';
import { useUser } from '@/Context/User';
import { Paginated } from '@/models/Paginated';
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
  auth,
}: PageProps<{ transmissions: Paginated<Transmission> }>) {
  const { openDialog } = useDialog();
  const { hasRole } = useUser();

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
            onSuccess: () => {},
          },
        );
      },
    });

  return (
    <>
      <Head title="Tipos de Câmbios">
        <Button onClick={() => handleAddFuelType()}>Adicionar</Button>
      </Head>

      <Filter searchProperties={['name']}>
        <ToggleTabs fieldName="showAll">
          <ToggleTab>Todos os tipos</ToggleTab>
          <ToggleTab value={false}>Meus tipos</ToggleTab>
        </ToggleTabs>
      </Filter>
      <Table
        data={transmissions}
        headers={TransmissionsHeader}
        onEdit={(color) => handleAddFuelType(color)}
        onDelete={handleDeleteFuelType}
        canDelete={(item) =>
          hasRole('admin') || item.created_by === auth.user.id
        }
        canEdit={(item) => hasRole('admin') || item.created_by === auth.user.id}
      />
    </>
  );
}