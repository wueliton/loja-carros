import { Card } from '@/Components/Card';
import { Head } from '@/Components/Head';
import { PageProps } from '@/types';
import { CarForm } from '../components/CarForm';

export default function CreateVehiclePage({}: PageProps) {
  return (
    <>
      <Head
        title="Adicionar Veículo"
        breadcrumb={[{ title: 'Veículos', url: route('cars.list.view') }]}
      />
      <Card>
        <CarForm postUrl={route('cars.create')} />
      </Card>
    </>
  );
}
