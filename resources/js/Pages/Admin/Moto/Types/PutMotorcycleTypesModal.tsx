import { Button } from '@/Components/Button';
import { DialogFooter } from '@/Components/Dialog/Footer';
import { DialogHeader } from '@/Components/Dialog/Header';
import { Input } from '@/Components/Forms/Input';
import { DialogProps } from '@/Context/Dialog';
import { AdminRoutes } from '@/constants';
import { MotorcycleTypes } from '@/models/MotorcycleTypes';
import { useForm } from '@inertiajs/react';
import { FC, FormEvent } from 'react';

export const PutMotorcycleTypeModal: FC<
  DialogProps<{ type?: MotorcycleTypes }>
> = ({ close, type }) => {
  const { data, errors, put, post, setData } = useForm<{
    id?: number;
    name?: string;
  }>({
    id: type?.id,
    name: type?.name,
  });

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    if (type) {
      put(route(AdminRoutes.MOTO_TYPES_EDIT, { id: data.id }), {
        onSuccess: () => close(true),
      });
      return;
    }

    post(route(AdminRoutes.MOTO_TYPES_CREATE), {
      onSuccess: () => close(true),
    });
  };

  return (
    <>
      <DialogHeader>
        <h2>{type ? 'Editar' : 'Novo'} Tipo</h2>
      </DialogHeader>
      <div className="text-left py-4">
        <form id="create-type-form" onSubmit={handleSubmit}>
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
        <Button color="primary" type="submit" form="create-type-form">
          Salvar
        </Button>
      </DialogFooter>
    </>
  );
};
