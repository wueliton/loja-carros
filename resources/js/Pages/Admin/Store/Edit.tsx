import { Button } from '@/Components/Button';
import { Card } from '@/Components/Card';
import { Autocomplete } from '@/Components/Forms/Autocomplete';
import { Input } from '@/Components/Forms/Input';
import { UploadFile } from '@/Components/Forms/UploadFile';
import { Head } from '@/Components/Head';
import { PageProps } from '@/types';
import { useStoreForm } from './hooks/useStoreForm';
import { UseStoreFormProps } from './hooks/useStoreForm/types';

const AdminEditStorePage = ({
  store,
}: PageProps<{ store: UseStoreFormProps['store'] }>) => {
  const { handleSubmit, data, errors, setData } = useStoreForm({
    store,
    postRoute: '',
  });

  return (
    <>
      <Head title={`Editar ${store.name}`} />
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
            required
          />
          <Input
            error={errors.store_number}
            value={data.store_number}
            label="Número"
            onChange={(e) => setData('store_number', e.target.value)}
            required
          />
          <Input
            error={errors.email}
            value={data.email}
            label="E-mail"
            onChange={(e) => setData('email', e.target.value)}
            required
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
            required
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
            required
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
            error={errors.logo_url}
            fieldName="Logo da Empresa"
            handle={
              <img
                src={`storage/uploads/${store.logo_url}`}
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
              url={route('api.admin.users.list')}
              searchProperties={['name']}
              name="administradores-conta"
              value={data.users}
              onChange={(e) => setData('users', e)}
              moreThanOne
              required
            />
          </div>
          <div className="col-span-full flex justify-end">
            <Button type="submit">Salvar</Button>
          </div>
        </form>
      </Card>
    </>
  );
};

export default AdminEditStorePage;
