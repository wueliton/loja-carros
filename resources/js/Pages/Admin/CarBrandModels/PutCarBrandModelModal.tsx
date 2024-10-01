import { Button } from '@/Components/Button';
import { DialogFooter } from '@/Components/Dialog/Footer';
import { DialogHeader } from '@/Components/Dialog/Header';
import { Autocomplete } from '@/Components/Forms/Autocomplete';
import { Input } from '@/Components/Forms/Input';
import { DialogProps } from '@/Context/Dialog';
import { Brand } from '@/models/Brand';
import { CarBrandModel } from '@/models/BrandModels';
import { useForm } from '@inertiajs/react';
import { FC, FormEvent } from 'react';

export const PutBrandModelModal: FC<
  DialogProps<{ brandModel?: CarBrandModel }>
> = ({ close, brandModel }) => {
  const { setData, data, errors, post, put } = useForm<{
    name?: string;
    brand?: number;
    id?: number;
  }>({
    name: brandModel?.name,
    brand: brandModel?.brand?.id,
    id: brandModel?.id,
  });

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    if (brandModel) {
      put(route(CarBrandModel.GET_ROUTE('update'), { id: data.id }), {
        onSuccess: () => close(true),
      });
      return;
    }

    post(route(CarBrandModel.GET_ROUTE('create')), {
      onSuccess: () => close(true),
    });
  };

  return (
    <>
      <DialogHeader>
        <h2>{brandModel ? 'Editar' : 'Novo'} Modelo</h2>
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
          <Autocomplete
            error={errors.brand}
            label="Marca"
            propertyToDisplay="name"
            propertyValue="id"
            url={route(Brand.GET_ROUTE('list'))}
            searchProperties={['name']}
            name="brands"
            value={data.brand}
            onChange={(e) => setData('brand', e)}
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
