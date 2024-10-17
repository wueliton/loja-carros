import { Button } from '@/Components/Button';
import { DialogFooter } from '@/Components/Dialog/Footer';
import { DialogHeader } from '@/Components/Dialog/Header';
import { Input } from '@/Components/Forms/Input';
import { DialogProps } from '@/Context/Dialog';
import { AdminRoutes } from '@/constants';
import { CarOptional } from '@/models/VehicleOptional';
import { useForm } from '@inertiajs/react';
import { FC, FormEvent } from 'react';

export const PutOptionalModal: FC<DialogProps<{ optional?: CarOptional }>> = ({
  close,
  optional,
}) => {
  const { setData, data, errors, post, put } = useForm<{
    name?: string;
    id?: number;
  }>({
    name: optional?.name,
    id: optional?.id,
  });

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    if (optional) {
      put(route(AdminRoutes.CAR_OPTIONALS_EDIT, { id: data.id }), {
        onSuccess: () => close(true),
      });
      return;
    }

    post(route(AdminRoutes.CAR_OPTIONALS_CREATE), {
      onSuccess: () => close(true),
    });
  };

  return (
    <>
      <DialogHeader>
        <h2>{optional ? 'Editar' : 'Novo'} Opcional</h2>
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
