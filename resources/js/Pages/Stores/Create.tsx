import { Button } from '@/Components/Button';
import { Card } from '@/Components/Card';
import { Autocomplete } from '@/Components/Forms/Autocomplete';
import { Input } from '@/Components/Forms/Input';
import { UploadFile } from '@/Components/Forms/UploadFile';
import { Head } from '@/Components/Head';
import { useDiscardUnsaved } from '@/Hooks/useDiscardUnsaved';
import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { PageProps } from '@/types';
import { useForm } from '@inertiajs/react';
import { FormEvent } from 'react';

export default function CreateStorePage({ auth }: PageProps) {
  const { data, setData, errors, isDirty, post, reset, transform } = useForm<{
    logo_url?: File;
    name?: string;
    store_number?: string;
    email?: string;
    phone?: string | number;
    whatsapp?: string | number;
    users: number[];
  }>({
    logo_url: undefined,
    name: '',
    store_number: '',
    email: '',
    users: [],
  });

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    transform((data) => ({
      ...data,
      phone: data.phone
        ? Number(String(data.phone)?.replace(/\D/g, ''))
        : undefined,
      whatsapp: data?.whatsapp
        ? Number(String(data.whatsapp)?.replace(/\D/g, ''))
        : undefined,
    }));
    e.preventDefault();
    post('/stores/create');
  };

  useDiscardUnsaved({ isDirty, onConfirm: () => reset() });

  return (
    <AuthenticatedLayout
      user={auth.user}
      head={
        <Head
          title="Nova Loja"
          breadcrumb={[{ title: 'Lojas', url: '/stores' }]}
        ></Head>
      }
    >
      <Card>
        <form
          className="grid grid-cols-1 md:grid-cols-2 gap-3"
          onSubmit={handleSubmit}
        >
          <Input
            error={errors.name}
            value={data.name}
            label="Nome"
            onChange={(e) => setData('name', e.target.value)}
            className="md:col-span-2"
          />
          <Input
            error={errors.store_number}
            value={data.store_number}
            label="Número"
            onChange={(e) => setData('store_number', e.target.value)}
          />
          <Input
            error={errors.email}
            value={data.email}
            label="E-mail"
            onChange={(e) => setData('email', e.target.value)}
          />
          <Input
            error={errors.phone}
            value={data.phone}
            label="Telefone"
            mask={[
              {
                mask: '(00) 90000-0000',
                comparison: (value: string) => value.charAt(5) === '9',
              },
              { mask: '(00) 0000-0000' },
            ]}
            onChange={(e) => setData('phone', e.target.value)}
          />
          <Input
            error={errors.whatsapp}
            value={data.whatsapp}
            label="WhatsApp"
            mask={[
              {
                mask: '(00) 90000-0000',
                comparison: (value: string) => value.charAt(5) === '9',
              },
              { mask: '(00) 0000-0000' },
            ]}
            onChange={(e) => setData('whatsapp', e.target.value)}
          />
          <UploadFile
            hint="JPG, PNG, WEBP ou GIF (Max 1MB)"
            className="md:col-span-2"
            onChange={(files) => setData('logo_url', files?.[0])}
            accept="image/png, image/jpg, image/webp, image/jpeg"
            error={errors.logo_url}
            fieldName="Logo da Empresa"
          />
          <div className="md:col-span-2 mt-2">
            <h2 className="text-lg font-bold">Administradores</h2>
            <Autocomplete
              error={errors.users}
              label="Administradores da Loja"
              propertyToDisplay="name"
              propertyValue="id"
              url={route('users.list')}
              searchProperties={['name']}
              name="administradores-conta"
              value={data.users}
              onChange={(e) => setData('users', e)}
              moreThanOne
            />
          </div>
          <div className="col-span-full flex justify-end">
            <Button type="submit">Salvar</Button>
          </div>
        </form>
      </Card>
    </AuthenticatedLayout>
  );
}
