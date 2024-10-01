import { Card } from '@/Components/Card';
import { Head } from '@/Components/Head';
import { PageProps } from '@/types';
import UpdatePasswordForm from './Partials/UpdatePasswordForm';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm';

export default function Edit({
  mustVerifyEmail,
  status,
}: PageProps<{ mustVerifyEmail: boolean; status?: string }>) {
  return (
    <>
      <Head title="Profile" hideTitle />
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
    </>
  );
}
