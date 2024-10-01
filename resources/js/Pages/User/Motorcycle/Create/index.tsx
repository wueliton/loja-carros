import { Card } from '@/Components/Card';
import { Head } from '@/Components/Head';
import { PageProps } from '@/types';
import { MotorcycleForm } from '../components/MotorcycleForm';

export default function CreateMotorcyclePage({}: PageProps) {
  return (
    <>
      <Head
        title="Adicionar Moto"
        breadcrumb={[{ title: 'Motos', url: 'motorcycle.list.view' }]}
      />
      <Card>
        <MotorcycleForm postUrl={route('motorcycle.create')} />
      </Card>
    </>
  );
}
