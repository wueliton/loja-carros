import { Button } from '@/Components/Button';
import { Autocomplete } from '@/Components/Forms/Autocomplete';
import { Input } from '@/Components/Forms/Input';
import { UploadFile } from '@/Components/Forms/UploadFile';
import { APIRoutes } from '@/constants';
import { FC } from 'react';
import { useStoreForm } from './hooks/useStoreForm';
import { StoreFormProps } from './types';

export const StoreForm: FC<StoreFormProps> = ({ store, postUrl }) => {
  const { data, setData, errors, handleSubmit } = useStoreForm({
    store,
    postUrl,
  });

  return (
    <form
      onSubmit={handleSubmit}
      className="grid grid-cols-1 md:grid-cols-2 gap-3"
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
      <Input
        error={errors.instagram}
        value={data.instagram}
        label="Instagram"
        onChange={(e) => setData('instagram', e.target.value)}
      />
      <Input
        error={errors.facebook}
        value={data.facebook}
        label="Facebook"
        onChange={(e) => setData('facebook', e.target.value)}
      />
      <Input
        error={errors.site}
        value={data.site}
        label="Site"
        onChange={(e) => setData('site', e.target.value)}
      />
      <UploadFile
        hint="JPG, PNG, WEBP ou GIF (Max 1MB)"
        className="md:col-span-2"
        onChange={(files) => setData('logo_url', files?.[0])}
        accept="image/png, image/jpg, image/webp, image/jpeg"
        error={errors.logo_url}
        fieldName="Logo da Empresa"
        handle={
          store ? (
            <img
              src={`storage/uploads/${store.logo_url}`}
              className="w-24 h-24 shadow rounded border border-gray-300 p-2 mb-4 object-contain"
              title={data.name}
            />
          ) : undefined
        }
      />
      <div className="md:col-span-2 mt-2">
        <h2 className="text-lg font-bold">Administradores</h2>
        <Autocomplete
          error={errors.users}
          label="Administradores da Loja"
          propertyToDisplay="name"
          propertyValue="id"
          url={route(APIRoutes.ADMIN_USERS_LIST)}
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
  );
};
