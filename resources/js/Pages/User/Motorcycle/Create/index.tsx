import { Card } from '@/Components/Card';
import { Head } from '@/Components/Head';
import { UserRoutes } from '@/constants';
import { PageProps } from '@/types';
import { MotorcycleForm } from '../components/MotorcycleForm';

export default function CreateMotorcyclePage({}: PageProps) {
  return (
    <>
      <Head
        title="Adicionar Moto"
        breadcrumb={[{ title: 'Motos', url: route(UserRoutes.MOTO_LIST) }]}
      />
      <Card>
        <MotorcycleForm postUrl={route(UserRoutes.MOTO_CREATE)} />
      </Card>
    </>
  );
}
