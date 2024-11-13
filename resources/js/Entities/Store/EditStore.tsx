import { Button } from '@/Components/Button';
import { Card } from '@/Components/Card';
import { Autocomplete } from '@/Components/Forms/Autocomplete';
import { Input } from '@/Components/Forms/Input';
import { useUser } from '@/Context/User';
import { useDiscardUnsaved } from '@/Hooks/useDiscardUnsaved';
import { Store } from '@/models/Store';
import { useForm } from '@inertiajs/react';
import { FC, FormEvent, useEffect } from 'react';

const StoreEdit: FC<{
  store: Store & { users_ids: number[] };
  postRoute: string;
}> = ({ store, postRoute }) => {
  const { hasRole } = useUser();

  const { data, setData, errors, isDirty, post, transform, reset } = useForm<
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
    post(postRoute);
  };

  useDiscardUnsaved(isDirty);

  useEffect(() => {
    reset();
  }, []);

  return (
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
          mask="brazilPhone"
          onChange={(e) => setData('phone', e.target.value)}
        />
        <Input
          error={errors.whatsapp}
          value={data.whatsapp}
          label="WhatsApp"
          mask="brazilPhone"
          onChange={(e) => setData('whatsapp', e.target.value)}
        />
        {/* <UploadFile
          hint="JPG, PNG, WEBP ou GIF (Max 1MB)"
          className="md:col-span-2"
          onChange={(files) => setData('logo_url', files?.[0])}
          error={errors.logo_url}
          fieldName="Logo da Empresa"
          handle={
            <img
              src={`storage/uploads/${store.logo_url}`}
              className="w-24 h-24 shadow rounded border border-gray-300 p-2 mb-4 object-contain"
              title={data.name}
            />
          }
        /> */}
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
            disabled={!hasRole('admin')}
            moreThanOne
          />
        </div>
        <div className="col-span-full flex justify-end">
          <Button type="submit">Salvar</Button>
        </div>
      </form>
    </Card>
  );
};

export default StoreEdit;
