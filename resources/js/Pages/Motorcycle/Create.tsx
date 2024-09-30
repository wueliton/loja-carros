import { Card } from '@/Components/Card';
import { Head } from '@/Components/Head';
import { Motorcycle } from '@/models/Motorcycle';
import { PageProps } from '@/types';
import { MotorcycleForm } from './components/MotorcycleForm';

export default function CreateMotorcyclePage({}: PageProps) {
  return (
    <>
      <Head
        title="Adicionar Moto"
        breadcrumb={[{ title: 'Motos', url: route('motorcycle') }]}
      />
      <Card>
        <MotorcycleForm postUrl={route(Motorcycle.GET_ROUTE('create'))} />
      </Card>
    </>
  );
}
