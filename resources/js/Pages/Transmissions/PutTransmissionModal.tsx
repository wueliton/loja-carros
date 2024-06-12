import { Button } from '@/Components/Button';
import { DialogFooter } from '@/Components/Dialog/Footer';
import { DialogHeader } from '@/Components/Dialog/Header';
import { Input } from '@/Components/Forms/Input';
import { DialogProps } from '@/Context/Dialog';
import { Transmission } from '@/models/Transmission';
import { useForm } from '@inertiajs/react';
import { FC, FormEvent } from 'react';

export const PutTransmissionModal: FC<
  DialogProps<{ transmission?: Transmission }>
> = ({ close, transmission }) => {
  const { setData, data, errors, post, put } = useForm<{
    name?: string;
    id?: number;
  }>({
    name: transmission?.name,
    id: transmission?.id,
  });

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    if (transmission) {
      put(route('transmissions.update', { id: data.id }), {
        onSuccess: () => close(true),
      });
      return;
    }

    post(route('transmissions.create'), {
      onSuccess: () => close(true),
    });
  };

  return (
    <>
      <DialogHeader>
        <h2>{transmission ? 'Editar' : 'Novo'} Tipo de Câmbio</h2>
      </DialogHeader>
      <div className="text-left py-4">
        <form id="create-color-form" onSubmit={handleSubmit}>
          <Input
            name="name"
            label="Nome"
            value={data.name}
            onChange={(e) => setData('name', e.target.value)}
            error={errors.name}
            autoFocus
          />
        </form>
      </div>
      <DialogFooter>
        <Button variant="basic" onClick={() => close()}>
          Cancelar
        </Button>
        <Button color="primary" type="submit" form="create-color-form">
          Salvar
        </Button>
      </DialogFooter>
    </>
  );
};
