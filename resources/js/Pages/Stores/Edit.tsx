import { Button } from '@/Components/Button';
import { Card } from '@/Components/Card';
import { Autocomplete } from '@/Components/Forms/Autocomplete';
import { Input } from '@/Components/Forms/Input';
import { UploadFile } from '@/Components/Forms/UploadFile';
import { Head } from '@/Components/Head';
import { useDiscardUnsaved } from '@/Hooks/useDiscardUnsaved';
import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { Store } from '@/models/Store';
import { PageProps } from '@/types';
import { useForm } from '@inertiajs/react';
import { FormEvent } from 'react';

export default function EditStore({
  store,
  auth,
}: PageProps<{ store: Store & { users_ids: number[] } }>) {
  const { data, setData, errors, isDirty, post, reset, transform } = useForm<
    Omit<Store, 'logo_url' | 'phone' | 'whatsapp'> & {
      phone?: string | number;
      whatsapp?: string | number;
      logo_url?: File;
      users: number[];
    }
  >({
    ...store,
    logo_url: undefined,
    users: store.users_ids,
    phone: String(store.phone),
    whatsapp: String(store.whatsapp),
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
    post(route(Store.GET_ROUTE('edit'), { id: store.id }));
  };

  useDiscardUnsaved({ isDirty, onConfirm: () => reset() });

  return (
    <AuthenticatedLayout
      user={auth.user}
      head={
        <Head
          title={`Editar ${store.name}`}
          breadcrumb={[{ title: 'Lojas', url: Store.GET_ROUTE() }]}
        />
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
            error={errors.logo_url}
            fieldName="Logo da Empresa"
            handle={
              <img
                src={`/files/${store.logo_url}`}
                className="w-24 h-24 shadow rounded border border-gray-300 p-2 mb-4 object-contain"
                title={data.name}
              />
            }
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
