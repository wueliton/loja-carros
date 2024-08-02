import { Button } from '@/Components/Button';
import { Input } from '@/Components/Forms/Input';
import { PageProps } from '@/types';
import { Transition } from '@headlessui/react';
import { Link, useForm, usePage } from '@inertiajs/react';
import { FormEventHandler } from 'react';

export default function UpdateProfileInformation({
  mustVerifyEmail,
  status,
  className = '',
}: {
  mustVerifyEmail: boolean;
  status?: string;
  className?: string;
}) {
  const user = usePage<PageProps>().props.auth.user;

  const { data, setData, patch, errors, processing, recentlySuccessful } =
    useForm({
      name: user.name,
      email: user.email,
    });

  const submit: FormEventHandler = (e) => {
    e.preventDefault();

    patch(route('profile.update'));
  };

  return (
    <section className={className}>
      <header>
        <h2 className="text-lg font-medium text-gray-900">Perfil</h2>

        <p className="mt-1 text-sm text-gray-600">
          Atualize as informações de sua conta.
        </p>
      </header>

      <form onSubmit={submit} className="mt-6">
        <Input
          label="Nome"
          name="name"
          value={data.name}
          onChange={(e) => setData('name', e.target.value)}
          required
          error={errors.name}
        />

        <Input
          label="E-mail"
          name="email"
          type="email"
          value={data.email}
          onChange={(e) => setData('email', e.target.value)}
          required
        />

        {mustVerifyEmail && user.email_verified_at === null && (
          <div>
            <p className="text-sm mt-2 text-gray-800">
              Seu e-mail não está verificado
              <Link
                href={route('verification.send')}
                method="post"
                as="button"
                className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >
                Clique aqui para reenviar o e-mail de validação.
              </Link>
            </p>

            {status === 'verification-link-sent' && (
              <div className="mt-2 font-medium text-sm text-green-600">
                Um novo e-mail de validação foi enviado, verifique seu e-mail.
              </div>
            )}
          </div>
        )}

        <div className="flex items-center gap-4">
          <Button disabled={processing}>Salvar</Button>

          <Transition
            show={recentlySuccessful}
            enter="transition ease-in-out"
            enterFrom="opacity-0"
            leave="transition ease-in-out"
            leaveTo="opacity-0"
          >
            <p className="text-sm text-gray-600">Salvo.</p>
          </Transition>
        </div>
      </form>
    </section>
  );
}
