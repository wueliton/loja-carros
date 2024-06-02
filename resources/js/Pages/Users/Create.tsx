import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { Head } from '@inertiajs/react';

export default function CreateUserPage({}) {
  return (
    <AuthenticatedLayout>
      <Head title="Editar" />
    </AuthenticatedLayout>
  );
}
