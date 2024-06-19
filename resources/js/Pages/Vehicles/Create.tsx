import { Card } from '@/Components/Card';
import { UploadFile } from '@/Components/Forms/UploadFile';
import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { PageProps } from '@/types';

export default function CreateVehiclePage({ auth }: PageProps) {
  return (
    <AuthenticatedLayout user={auth.user}>
      <Card>
        <form>
          <UploadFile
            hint="JPG, PNG, WEBP ou GIF (Max 1MB)"
            fieldName="Logo da Empresa"
            accept="image/png, image/jpg, image/webp, image/jpeg"
            isMultiple
          />
        </form>
      </Card>
    </AuthenticatedLayout>
  );
}
