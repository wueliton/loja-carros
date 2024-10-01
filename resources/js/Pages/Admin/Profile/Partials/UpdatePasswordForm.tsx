import { Button } from '@/Components/Button';
import { Input } from '@/Components/Forms/Input';
import { Transition } from '@headlessui/react';
import { useForm } from '@inertiajs/react';
import { FormEventHandler, useRef } from 'react';

export default function UpdatePasswordForm({
  className = '',
}: {
  className?: string;
}) {
  const passwordInput = useRef<HTMLInputElement>(null);
  const currentPasswordInput = useRef<HTMLInputElement>(null);

  const { data, setData, errors, put, reset, processing, recentlySuccessful } =
    useForm({
      current_password: '',
      password: '',
      password_confirmation: '',
    });

  const updatePassword: FormEventHandler = (e) => {
    e.preventDefault();

    put(route('password.update'), {
      preserveScroll: true,
      onSuccess: () => reset(),
      onError: (errors) => {
        if (errors.password) {
          reset('password', 'password_confirmation');
          passwordInput.current?.focus();
        }

        if (errors.current_password) {
          reset('current_password');
          currentPasswordInput.current?.focus();
        }
      },
    });
  };

  return (
    <section className={className}>
      <header>
        <h2 className="text-lg font-medium text-gray-900">Atualizar Senha</h2>

        <p className="mt-1 text-sm text-gray-600">
          Certifique-se de que sua conta esteja usando uma senha longa e
          aleatória para permanecer segura.
        </p>
      </header>

      <form onSubmit={updatePassword} className="mt-6">
        <Input
          label="Senha Atual"
          ref={currentPasswordInput}
          value={data.current_password}
          onChange={(e) => setData('current_password', e.target.value)}
          type="password"
          error={errors.current_password}
          required
        />

        <Input
          label="Nova Senha"
          id="password"
          ref={passwordInput}
          value={data.password}
          onChange={(e) => setData('password', e.target.value)}
          type="password"
          error={errors.password}
          required
        />

        <Input
          label="Confirmação da Nova Senha"
          id="password_confirmation"
          value={data.password_confirmation}
          onChange={(e) => setData('password_confirmation', e.target.value)}
          type="password"
          error={errors.password_confirmation}
          required
        />

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
