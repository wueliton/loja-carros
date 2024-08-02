import { Card } from '@/Components/Card';
import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { PageProps } from '@/types';
import { Head } from '@inertiajs/react';
import UpdatePasswordForm from './Partials/UpdatePasswordForm';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm';

export default function Edit({
  mustVerifyEmail,
  status,
  auth,
}: PageProps<{ mustVerifyEmail: boolean; status?: string }>) {
  return (
    <AuthenticatedLayout user={auth.user}>
      <Head title="Profile" />
      <div className="flex flex-col gap-4">
        <Card>
          <UpdateProfileInformationForm
            mustVerifyEmail={mustVerifyEmail}
            status={status}
            className="max-w-xl"
          />
        </Card>

        <Card>
          <UpdatePasswordForm className="max-w-xl" />
        </Card>

        {/* <Card>
          <DeleteUserForm className="max-w-xl" />
        </Card> */}
      </div>
    </AuthenticatedLayout>
  );
}
