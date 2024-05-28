import { Button } from '@/Components/Button';
import { Card } from '@/Components/Card';
import { Autocomplete } from '@/Components/Forms/Autocomplete';
import { Input } from '@/Components/Forms/Input';
import { UploadFile } from '@/Components/Forms/UploadFile';
import { Head } from '@/Components/Head';
import { useDialog } from '@/Context/Dialog';
import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { router, useForm } from '@inertiajs/react';
import { FormEvent, useEffect } from 'react';

export default function NewStorePage() {
  const { openDialog } = useDialog();
  const { data, setData, errors, isDirty, post, reset, transform } = useForm<{
    logo_url?: File;
    name?: string;
    store_number?: string;
    email?: string;
    phone?: string | number;
    whatsapp?: string | number;
  }>({
    logo_url: undefined,
    name: '',
    store_number: '',
    email: '',
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

  useEffect(() => {
    return router.on('before', (event) => {
      if (!isDirty || event.detail.visit.method !== 'get') return true;
      openDialog({
        content: {
          title: 'Deseja sair?',
          content:
            'Há alterações não salvas no formulário, ao sair essas alterações serão perdidas.',
        },
        onClose: (confirm) => {
          if (!confirm) return;
          reset();
          setTimeout(() => {
            router.visit(event.detail.visit.url);
          }, 10);
        },
      });
      return false;
    });
  }, [isDirty]);

  return (
    <AuthenticatedLayout>
      <Head
        title="Nova Loja"
        breadcrumb={[{ title: 'Lojas', url: '/stores' }]}
      ></Head>
      <Card>
        <form
          className="grid grid-cols-1 md:grid-cols-2 gap-3"
          onSubmit={handleSubmit}
        >
          <Autocomplete
            label="Busca"
            propertyToDisplay="name"
            propertyValue="id"
            url={route('users.list')}
            searchProperties={['name']}
          />
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
            label="Endereço"
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
            mask="(__) ____-____"
            replacement={{ _: /\d/ }}
            modify={(input) => ({
              mask: input[2] === '9' ? '(__) _____-____' : undefined,
            })}
            showMask
            onChange={(e) => setData('phone', e.target.value)}
          />
          <Input
            error={errors.whatsapp}
            value={data.whatsapp}
            label="WhatsApp"
            mask="(__) ____-____"
            replacement={{ _: /\d/ }}
            modify={(input) => ({
              mask: input[2] === '9' ? '(__) _____-____' : undefined,
            })}
            showMask
            onChange={(e) => setData('whatsapp', e.target.value)}
          />
          <UploadFile
            hint="JPG, PNG, WEBP ou GIF (Max 1MB)"
            className="md:col-span-2"
            onChange={(files) => setData('logo_url', files?.[0])}
          />
          <div className="col-span-full flex justify-end">
            <Button type="submit">Salvar</Button>
          </div>
        </form>
      </Card>
    </AuthenticatedLayout>
  );
}
