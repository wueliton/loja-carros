import { Button } from '@/Components/Button';
import { DialogFooter } from '@/Components/Dialog/Footer';
import { DialogHeader } from '@/Components/Dialog/Header';
import { Input } from '@/Components/Forms/Input';
import { DialogProps } from '@/Context/Dialog';
import { AdminRoutes } from '@/constants';
import { MotorcycleOptional } from '@/models/MotorcycleOptional';
import { useForm } from '@inertiajs/react';
import { FC, FormEvent } from 'react';

export const PutMotorcycleOptionalModal: FC<
  DialogProps<{ optional?: MotorcycleOptional }>
> = ({ close, optional }) => {
  const { data, errors, put, post, setData } = useForm<{
    id?: number;
    name?: string;
  }>({
    id: optional?.id,
    name: optional?.name,
  });

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    if (optional) {
      put(route(AdminRoutes.MOTO_OPTIONALS_EDIT, { id: data.id }), {
        onSuccess: () => close(true),
      });
      return;
    }

    post(route(AdminRoutes.MOTO_OPTIONALS_CREATE), {
      onSuccess: () => close(true),
    });
  };

  return (
    <>
      <DialogHeader>
        <h2>{optional ? 'Editar' : 'Novo'} Opcional</h2>
      </DialogHeader>
      <div className="text-left py-4">
        <form id="create-optional-form" onSubmit={handleSubmit}>
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
        <Button color="primary" type="submit" form="create-optional-form">
          Salvar
        </Button>
      </DialogFooter>
    </>
  );
};
