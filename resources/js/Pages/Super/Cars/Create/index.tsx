import { Card } from '@/Components/Card';
import { Head } from '@/Components/Head';
import { SuperRoutes } from '@/constants';
import { PageProps } from '@/types';
import { CarForm } from '../components/CarForm';

export default function CreateVehiclePage({}: PageProps) {
  return (
    <>
      <Head
        title="Adicionar Veículo"
        breadcrumb={[
          { title: 'Veículos', url: route(SuperRoutes.CAR_LIST_VIEW) },
        ]}
      />
      <Card>
        <CarForm postUrl={route(SuperRoutes.CAR_CREATE)} />
      </Card>
    </>
  );
}
