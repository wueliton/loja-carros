import { Button } from '@/Components/Button';
import { Card } from '@/Components/Card';
import { Autocomplete } from '@/Components/Forms/Autocomplete';
import { Editor } from '@/Components/Forms/Editor';
import { Input } from '@/Components/Forms/Input';
import { UploadFile } from '@/Components/Forms/UploadFile';
import { Head } from '@/Components/Head';
import { TrashIcon } from '@/Components/Icons/Trash';
import { useDialog } from '@/Context/Dialog';
import { useDiscardUnsaved } from '@/Hooks/useDiscardUnsaved';
import { Car } from '@/models/Car';
import { PageProps } from '@/types';
import { useForm } from '@inertiajs/react';
import axios from 'axios';
import { FormEvent, useMemo, useState } from 'react';

export default function EditCarPage({ car }: PageProps<{ car: Car }>) {
  const currentYear = useMemo(() => new Date().getFullYear(), []);
  const { openDialog } = useDialog();
  const [currentFiles, setCurrentFiles] = useState<Car['images']>(car.images);
  const { data, setData, errors, post, isDirty } = useForm<{
    title?: string;
    store?: number;
    brand?: number;
    model?: number;
    price?: string;
    manufacturingYear?: number;
    year?: number;
    version?: string;
    color?: number;
    fuelType?: number;
    doors?: number;
    transmission?: number;
    motor?: string;
    km?: number;
    lastDigit?: number;
    optionals?: (number | undefined)[];
    images?: File[];
    details?: string;
  }>({
    ...car,
    brand: car.brand_id,
    model: car.model_id,
    color: car.color_id,
    store: car.store_id,
    fuelType: car.fuel_type_id,
    transmission: car.transmission_id,
    optionals: car.optionals?.map((optional) => optional.id) ?? [],
    manufacturingYear: car.manufacturing_year,
    lastDigit: car.last_digit,
    images: [],
  });

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    post(route(Car.GET_ROUTE('edit'), { id: car.id }));
  };

  const handleDeleteFile = (id?: number) => {
    openDialog({
      content: {
        title: 'Deseja excluir a imagem?',
        icon: <TrashIcon />,
        content: 'Esta ação não poderá ser revertida.',
      },
      onClose: (data) => {
        if (!data) return;

        axios
          .delete(route(Car.GET_ROUTE('deleteImage'), { id }))
          .then(() =>
            setCurrentFiles((prev) => prev?.filter((img) => img.id !== id)),
          );
      },
    });
  };

  useDiscardUnsaved(isDirty);

  return (
    <>
      <Head
        title={`Editar ${car.title}`}
        breadcrumb={[{ title: 'Carros', url: route(Car.GET_ROUTE()) }]}
      />
      <Card>
        <form
          className="grid grid-cols-1 md:grid-cols-2 gap-3"
          onSubmit={handleSubmit}
        >
          <Input
            label="Título"
            className="md:col-span-2"
            value={data.title}
            onChange={(e) => setData('title', e.target.value)}
            error={errors.title}
            required
          />
          <Autocomplete
            label="Loja"
            propertyToDisplay="name"
            propertyValue="id"
            url={route('stores.list')}
            searchProperties={['name']}
            value={data.store}
            onChange={(e) => {
              setData('store', e);
            }}
            className="md:col-span-2"
            name="store"
            error={errors.store}
            required
          />
          <h2 className="md:col-span-2 text-lg font-bold">Dados gerais</h2>
          <Autocomplete
            label="Marca"
            propertyToDisplay="name"
            propertyValue="id"
            url={route('brands.list')}
            searchProperties={['name']}
            value={data.brand}
            onChange={(e) => {
              setData({
                ...data,
                brand: e,
                model: undefined,
              });
            }}
            name="brand"
            error={errors.brand}
            required
          />
          <Autocomplete
            label="Modelo"
            propertyToDisplay="name"
            propertyValue="id"
            url={route('brandModels.list')}
            searchProperties={['name']}
            name="models"
            disabled={!data.brand}
            onChange={(e) => setData('model', e)}
            filter={[
              {
                fieldName: 'brand_id',
                comparison: 'equals',
                value: data.brand,
              },
            ]}
            value={data.model}
            error={errors.model}
            required
          />
          <Input
            label="Valor"
            value={data.price}
            unmaskedValueChange={(e) => setData('price', e)}
            error={errors.price}
            required
            prefix={
              <span className="p-2 min-w-10 text-center bg-gray-50">R$</span>
            }
            mask={Number}
            maskOptions={{
              radix: ',',
              scale: 2,
              thousandsSeparator: '.',
              padFractionalZeros: true,
              normalizeZeros: true,
            }}
          />
          <Input
            label="Ano de Fabricação"
            type="number"
            min={1900}
            max={currentYear}
            step={1}
            value={data.manufacturingYear}
            onChange={(e) => setData('manufacturingYear', +e.target.value)}
            error={errors.manufacturingYear}
            required
          />
          <Input
            label="Ano"
            type="number"
            min={1900}
            max={currentYear}
            value={data.year}
            step={1}
            onChange={(e) => setData('year', +e.target.value)}
            error={errors.year}
            required
          />
          <Input
            label="Versão"
            value={data.version}
            onChange={(e) => setData('version', e.target.value)}
            error={errors.version}
          />
          <Autocomplete
            label="Cor"
            propertyToDisplay="color"
            propertyValue="id"
            url={route('colors.list')}
            searchProperties={['color']}
            value={data.color}
            onChange={(e) => setData('color', e)}
            name="color"
            error={errors.color}
            required
          />
          <Autocomplete
            label="Tipo de combustível"
            propertyToDisplay="name"
            propertyValue="id"
            url={route('fuelTypes.list')}
            searchProperties={['name']}
            value={data.fuelType}
            onChange={(e) => setData('fuelType', e)}
            name="fuelType"
            error={errors.fuelType}
            required
          />
          <Input
            label="Portas"
            type="number"
            min={1}
            value={data.doors}
            onChange={(e) => setData('doors', +e.target.value)}
            error={errors.doors}
            required
          />
          <Autocomplete
            label="Transmissão"
            propertyToDisplay="name"
            propertyValue="id"
            url={route('transmissions.list')}
            searchProperties={['name']}
            value={data.transmission}
            onChange={(e) => setData('transmission', e)}
            name="transmission"
            error={errors.transmission}
            required
          />
          <Input
            label="Motor"
            type="number"
            step={0.1}
            value={data.motor}
            onChange={(e) => setData('motor', e.target.value)}
            name="motor"
            error={errors.motor}
            required
          />
          <Input
            label="Quilômetros"
            type="number"
            step={0.1}
            min={0}
            value={data.km}
            onChange={(e) => setData('km', +e.target.value)}
            suffix={<span className="p-2 bg-gray-50">km</span>}
            name="km"
            error={errors.km}
            required
          />
          <Input
            label="Último dígito da placa"
            value={data.lastDigit}
            onChange={(e) => setData('lastDigit', +e.target.value)}
            name="lastDigit"
            error={errors.lastDigit}
            type="number"
            required
          />
          <h2 className="md:col-span-2 text-lg font-bold mt-4">Imagens</h2>
          <UploadFile
            hint="JPG, PNG, WEBP ou GIF (Max 1MB)"
            fieldName="Logo da Empresa"
            accept="image/png, image/jpg, image/webp, image/jpeg"
            maxFiles={5}
            className="md:col-span-2"
            onChange={(files) => setData('images', files)}
            error={errors.images}
            onDelete={(file) => handleDeleteFile(file.id)}
            files={currentFiles?.map((image) => ({
              ...image,
              fileName: image.url,
            }))}
            isMultiple
          />
          <h2 className="md:col-span-2 text-lg font-bold mt-4">Observações</h2>
          <Editor
            className="md:col-span-2"
            value={data.details}
            onChange={(data) => setData('details', data)}
            error={errors.details}
          />
          <h2 className="md:col-span-2 text-lg font-bold mt-4">Outros</h2>
          <Autocomplete
            label="Opcionais"
            propertyToDisplay="name"
            propertyValue="id"
            url={route('optional.list')}
            searchProperties={['name']}
            value={data.optionals}
            onChange={(e) => setData('optionals', e)}
            name="optionals"
            className={'md:col-span-2'}
            moreThanOne
            error={errors.optionals}
          />
          <div className="col-span-full flex justify-end">
            <Button type="submit">Salvar</Button>
          </div>
        </form>
      </Card>
    </>
  );
}
