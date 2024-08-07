import { Button } from '@/Components/Button';
import { Card } from '@/Components/Card';
import { Autocomplete } from '@/Components/Forms/Autocomplete';
import { Editor } from '@/Components/Forms/Editor';
import { Input } from '@/Components/Forms/Input';
import { UploadFile } from '@/Components/Forms/UploadFile';
import { Head } from '@/Components/Head';
import { useDiscardUnsaved } from '@/Hooks/useDiscardUnsaved';
import { Color } from '@/models/Color';
import { Motorcycle } from '@/models/Motorcycle';
import { MotorcycleBrandModels } from '@/models/MotorcycleBrandModels';
import { MotorcycleOptional } from '@/models/MotorcycleOptional';
import { MotorcycleTypes } from '@/models/MotorcycleTypes';
import { PageProps } from '@/types';
import { useForm } from '@inertiajs/react';
import { FormEvent, useMemo } from 'react';

export default function CreateMotorcyclePage({}: PageProps) {
  const currentYear = useMemo(() => new Date().getFullYear(), []);
  const { data, setData, errors, post, isDirty } = useForm<{
    title?: string;
    store?: number;
    brand?: number;
    price?: string;
    model?: number;
    type?: number;
    manufacturingYear?: number;
    year?: number;
    cylinder?: string;
    motor?: string;
    color?: number;
    km?: number;
    fuelCapacity?: number;
    size?: string;
    axisLength?: string;
    optionals?: number[];
    images?: File[];
    details?: string;
  }>({
    year: currentYear,
    manufacturingYear: currentYear,
  });

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    post(route(Motorcycle.GET_ROUTE('create')));
  };

  useDiscardUnsaved(isDirty);

  return (
    <>
      <Head
        title="Adicionar Moto"
        breadcrumb={[{ title: 'Motos', url: route('motorcycle') }]}
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
            error={errors.brand}
            onChange={(e) => {
              setData({
                ...data,
                brand: e,
                model: undefined,
              });
            }}
            name="brand"
            required
          />
          <Autocomplete
            label="Modelo"
            propertyToDisplay="name"
            propertyValue="id"
            url={route(MotorcycleBrandModels.GET_ROUTE('list'))}
            searchProperties={['name']}
            name="models"
            disabled={!data.brand}
            onChange={(e) => setData('model', e)}
            error={errors.model}
            filter={[
              {
                fieldName: 'brand_id',
                comparison: 'equals',
                value: data.brand,
              },
            ]}
            value={data.model}
            required
          />
          <Autocomplete
            label="Tipo"
            propertyToDisplay="name"
            propertyValue="id"
            url={route(MotorcycleTypes.GET_ROUTE('list'))}
            searchProperties={['name']}
            name="type"
            onChange={(e) => setData('type', e)}
            value={data.type}
            error={errors.type}
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
            error={errors.manufacturingYear}
            onChange={(e) => setData('manufacturingYear', +e.target.value)}
            required
          />
          <Input
            label="Ano"
            type="number"
            min={1900}
            max={currentYear}
            value={data.year}
            step={1}
            error={errors.year}
            onChange={(e) => setData('year', +e.target.value)}
            required
          />
          <Input
            label="Cilindradas"
            value={data.cylinder}
            error={errors.cylinder}
            onChange={(e) => setData('cylinder', e.target.value)}
            required
          />
          <Input
            label="Motor"
            value={data.motor}
            error={errors.motor}
            onChange={(e) => setData('motor', e.target.value)}
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
          <Autocomplete
            label="Cor"
            propertyToDisplay="color"
            propertyValue="id"
            url={route(Color.GET_ROUTE('list'))}
            searchProperties={['color']}
            value={data.color}
            onChange={(e) => setData('color', e)}
            name="color"
            error={errors.color}
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
            isMultiple
          />
          <h2 className="md:col-span-2 text-lg font-bold mt-4">Observações</h2>
          <Editor
            className="md:col-span-2"
            value={data.details}
            onChange={(data) => setData('details', data)}
            error={errors.details}
          />
          <h2 className="md:col-span-2 text-lg font-bold mt-4">
            Desempenho e dimensões
          </h2>
          <Input
            label="Comprimento x Altura x Largura"
            value={data.size}
            onChange={(e) => setData('size', e.target.value)}
            name="size"
            error={errors.size}
          />
          <Input
            label="Tanque de combustível"
            type="number"
            step={1}
            min={1}
            value={data.fuelCapacity}
            onChange={(e) => setData('fuelCapacity', +e.target.value)}
            suffix={
              <span className="p-2 min-w-10 text-center bg-gray-50">L</span>
            }
            name="fuelCapacity"
            error={errors.fuelCapacity}
            required
          />
          <Input
            label="Distância entre eixos"
            value={data.axisLength}
            onChange={(e) => setData('axisLength', e.target.value)}
            name="axisLength"
            error={errors.axisLength}
          />
          <h2 className="md:col-span-2 text-lg font-bold mt-4">Outros</h2>
          <Autocomplete
            label="Opcionais"
            propertyToDisplay="name"
            propertyValue="id"
            url={route(MotorcycleOptional.GET_ROUTE('list'))}
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
