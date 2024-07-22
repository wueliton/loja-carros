import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { THeadProps, Table } from '@/Components/Table';
import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { Motorcycle } from '@/models/Motorcycle';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';
import moment from 'moment';
import 'moment/dist/locale/pt-br';
import { Tooltip } from 'react-tooltip';

moment.locale('pt-br');

const motorcycleHeader: THeadProps<Motorcycle>[] = [
  {
    key: 'title',
    title: 'Título Anuncio',
  },
  {
    key: 'brand',
    title: 'Marca',
    render: (data) => <>{data.brand?.name}</>,
  },
  {
    key: 'model',
    title: 'Modelo',
    render: (data) => <>{data.model?.name}</>,
  },
  {
    key: 'created_at',
    title: 'Data de Criação',
    render: (data) => (
      <>
        <span
          data-tooltip-id="created_at"
          data-tooltip-content={moment(data.created_at).format(
            'DD/MM/YYYY HH:mm:ss',
          )}
        >
          {moment.duration(moment().diff(data.created_at)).humanize()}
        </span>
      </>
    ),
  },
];

export default function MotorcyclePage({
  auth,
  motorcycles,
}: PageProps<{ motorcycles: Motorcycle[] }>) {
  return (
    <>
      <AuthenticatedLayout
        user={auth.user}
        head={
          <Head title="Motos">
            <Button
              onClick={() => router.visit(route('motorcycle.createView'))}
            >
              Adicionar
            </Button>
          </Head>
        }
      >
        <Table data={motorcycles} headers={motorcycleHeader} />
      </AuthenticatedLayout>
      <Tooltip id="created_at" />
    </>
  );
}
