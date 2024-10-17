import { Card } from '@/Components/Card';
import { Head } from '@/Components/Head';
import { UserRoutes } from '@/constants';
import { PageProps } from '@/types';
import { CarForm } from '../components/CarForm';

export default function CreateVehiclePage({}: PageProps) {
  return (
    <>
      <Head
        title="Adicionar Veículo"
        breadcrumb={[{ title: 'Veículos', url: route(UserRoutes.CAR_LIST) }]}
      />
      <Card>
        <CarForm postUrl={route(UserRoutes.CAR_CREATE)} />
      </Card>
    </>
  );
}
