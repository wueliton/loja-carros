import { Button } from '@/Components/Button';
import { Head } from '@/Components/Head';
import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { PageProps } from '@/types';
import { router } from '@inertiajs/react';

export default function ListVehiclesPage({ auth }: PageProps) {
  return (
    <AuthenticatedLayout
      user={auth.user}
      head={
        <Head title="Veículos">
          <Button onClick={() => router.visit('vehicles/create')}>
            Adicionar
          </Button>
        </Head>
      }
    ></AuthenticatedLayout>
  );
}
