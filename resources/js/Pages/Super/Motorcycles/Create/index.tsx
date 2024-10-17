import { Card } from '@/Components/Card';
import { Head } from '@/Components/Head';
import { SuperRoutes } from '@/constants';
import { PageProps } from '@/types';
import { MotorcycleForm } from '../components/MotorcycleForm';

export default function CreateMotorcyclePage({}: PageProps) {
  return (
    <>
      <Head
        title="Adicionar Moto"
        breadcrumb={[
          { title: 'Motos', url: route(SuperRoutes.MOTORCYCLE_LIST_VIEW) },
        ]}
      />
      <Card>
        <MotorcycleForm postUrl={route(SuperRoutes.MOTORCYCLE_CREATE)} />
      </Card>
    </>
  );
}
