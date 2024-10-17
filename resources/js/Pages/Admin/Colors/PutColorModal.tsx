import { Button } from '@/Components/Button';
import { DialogFooter } from '@/Components/Dialog/Footer';
import { DialogHeader } from '@/Components/Dialog/Header';
import { Input } from '@/Components/Forms/Input';
import { DialogProps } from '@/Context/Dialog';
import { AdminRoutes } from '@/constants';
import { Color } from '@/models/Color';
import { useForm } from '@inertiajs/react';
import { FC, FormEvent } from 'react';

export const PutColorModal: FC<DialogProps<{ color?: Color }>> = ({
  close,
  color,
}) => {
  const { setData, data, errors, post, put } = useForm<{
    color?: string;
    id?: number;
  }>({
    color: color?.color,
    id: color?.id,
  });

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    if (color) {
      put(route(AdminRoutes.COLORS_EDIT, { id: data.id }), {
        onSuccess: () => close(true),
      });
      return;
    }

    post(route(AdminRoutes.COLORS_CREATE), {
      onSuccess: () => close(true),
    });
  };

  return (
    <>
      <DialogHeader>
        <h2>{color ? 'Editar' : 'Nova'} Cor</h2>
      </DialogHeader>
      <div className="text-left py-4">
        <form id="create-color-form" onSubmit={handleSubmit}>
          <Input
            name="name"
            label="Nome"
            value={data.color}
            onChange={(e) => setData('color', e.target.value)}
            error={errors.color}
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
