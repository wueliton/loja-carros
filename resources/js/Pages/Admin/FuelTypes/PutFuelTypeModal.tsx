import { Button } from '@/Components/Button';
import { DialogFooter } from '@/Components/Dialog/Footer';
import { DialogHeader } from '@/Components/Dialog/Header';
import { Input } from '@/Components/Forms/Input';
import { DialogProps } from '@/Context/Dialog';
import { FuelType } from '@/models/FuelType';
import { useForm } from '@inertiajs/react';
import { FC, FormEvent } from 'react';

export const PutFuelTypeModal: FC<DialogProps<{ fuelType?: FuelType }>> = ({
  close,
  fuelType,
}) => {
  const { setData, data, errors, post, put } = useForm<{
    name?: string;
    id?: number;
  }>({
    name: fuelType?.name,
    id: fuelType?.id,
  });

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    if (fuelType) {
      put(route(FuelType.GET_ROUTE('update'), { id: data.id }), {
        onSuccess: () => close(true),
      });
      return;
    }

    post(route(FuelType.GET_ROUTE('create')), {
      onSuccess: () => close(true),
    });
  };

  return (
    <>
      <DialogHeader>
        <h2>{fuelType ? 'Editar' : 'Novo'} Tipo de Combustível</h2>
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
