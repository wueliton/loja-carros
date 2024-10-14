import { Button } from '@/Components/Button';
import { Card } from '@/Components/Card';
import { Input } from '@/Components/Forms/Input';
import { UploadFile } from '@/Components/Forms/UploadFile';
import { Head } from '@/Components/Head';
import { InfoBlockMessage } from '@/Components/InfoBlockMessage';
import { Store } from '@/models/Store';
import { PageProps } from '@/types';
import { formatPhoneNumber } from '@/utils/format_phone_number';
import { useStoreForm } from './hooks/useStoreForm';

export default function EditStore({
  store,
  changeRequest,
}: PageProps<{ store: Store; changeRequest: Store }>) {
  const canCreateChangeRequest = false;
  const { data, onSubmit, errors, setData, editState, setEditState } =
    useStoreForm({
      store,
    });

  return (
    <>
      <Head title={store.name!} />
      <div className="flex gap-3 flex-col">
        {changeRequest ? (
          <InfoBlockMessage>
            <h3 className="text-lg font-bold">Solicitação Pendente</h3>
            <p>
              Sua solicitação de alteração dos dados desta loja está pendente de
              aprovação.
            </p>
          </InfoBlockMessage>
        ) : null}
        <Card>
          {editState ? (
            <form
              className="grid grid-cols-1 md:grid-cols-2 gap-3"
              onSubmit={onSubmit}
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
                error={errors.logo_url}
                fieldName="Logo da Empresa"
                maxFiles={1}
                handle={
                  <img
                    src={`storage/uploads/${store.logo_url}`}
                    className="w-24 h-24 shadow rounded border border-gray-300 p-2 mb-4 object-contain"
                    title={data.name}
                  />
                }
              />
              <div className="col-span-full flex justify-end gap-2">
                <Button
                  type="button"
                  variant="basic"
                  onClick={() => setEditState(false)}
                >
                  Cancelar
                </Button>
                <Button type="submit">Enviar</Button>
              </div>
            </form>
          ) : (
            <>
              <div className="flex gap-5">
                <img
                  src={`storage/uploads/${store.logo_url}`}
                  className="w-24 h-24 mb-4 object-contain"
                  title={data.name}
                />
                <div className="flex flex-col gap-2">
                  <h2 className="text-2xl">{store.name}</h2>
                  <p>
                    <strong>Número:</strong> {store.store_number}
                  </p>
                  <p>
                    <strong>E-mail:</strong> {store.email}
                  </p>
                  <p>
                    <strong>Telefone:</strong> {formatPhoneNumber(store.phone!)}
                  </p>
                  <p>
                    <strong>Whatsapp:</strong>{' '}
                    {formatPhoneNumber(store.whatsapp!)}
                  </p>
                  <p>
                    <strong>Facebook:</strong> {store.facebook}
                  </p>
                  <p>
                    <strong>Instagram:</strong> {store.instagram}
                  </p>
                  <p>
                    <strong>Site:</strong> {store.site}
                  </p>
                </div>
              </div>
              {canCreateChangeRequest ? (
                <div className="col-span-full flex justify-end mt-3">
                  <Button type="submit" onClick={() => setEditState(true)}>
                    Sugerir Alteração
                  </Button>
                </div>
              ) : null}
            </>
          )}
        </Card>
      </div>
    </>
  );
}
