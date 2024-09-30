import { Card } from '@/Components/Card';
import { Head } from '@/Components/Head';
import { Car } from '@/models/Car';
import { PageProps } from '@/types';
import { CarForm } from './components/CarForm';

export default function CreateVehiclePage({}: PageProps) {
  return (
    <>
      <Head
        title="Adicionar Veículo"
        breadcrumb={[{ title: 'Veículos', url: route('cars') }]}
      />
      <Card>
        <CarForm postUrl={route(Car.GET_ROUTE('create'))} />
      </Card>
    </>
  );
}
