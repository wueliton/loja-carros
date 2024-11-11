import { Button } from '@/Components/Button';
import { Autocomplete } from '@/Components/Forms/Autocomplete';
import { Editor } from '@/Components/Forms/Editor';
import { Input } from '@/Components/Forms/Input';
import { UploadFile } from '@/Components/Forms/UploadFile';
import { APIRoutes } from '@/constants';
import { useCarForm } from './hooks/useCarForm';
import { CarFormProps } from './types';

export const CarForm: React.FC<CarFormProps> = ({
  postUrl,
  defaultValues,
  images,
}) => {
  const {
    onSubmit,
    data,
    setData,
    errors,
    commonService,
    carService,
    currentYear,
    selectedFiles,
    handleCreateModel,
    handleDeleteFile,
  } = useCarForm({ postUrl, defaultValues, images });
  const { createBrand, createColor, createFuelType } = commonService;
  const { createOptional, createTransmission } = carService;

  return (
    <form className="grid grid-cols-1 md:grid-cols-2 gap-3" onSubmit={onSubmit}>
      <Input
        label="Título"
        className="md:col-span-2"
        value={data.title}
        onChange={(e) => setData('title', e.target.value)}
        error={errors.title}
        required
      />
      <h2 className="md:col-span-2 text-lg font-bold">Dados gerais</h2>
      <Autocomplete
        label="Loja"
        propertyToDisplay="name"
        propertyValue="id"
        url={route(APIRoutes.SUPER_STORE_LIST)}
        searchProperties={['name']}
        value={data.storeId}
        onChange={(e) => setData('storeId', e as number)}
        name="storeId"
        error={errors.brand}
        className="md:col-span-2"
        required
      />
      <Autocomplete
        label="Marca"
        propertyToDisplay="name"
        propertyValue="id"
        url={route(APIRoutes.BRAND_LIST)}
        searchProperties={['name']}
        value={data.brand}
        onChange={(e) => {
          setData({
            ...data,
            brand: e as number,
            model: undefined,
          });
        }}
        onCreate={createBrand}
        name="brand"
        error={errors.brand}
        required
      />
      <Autocomplete
        label="Modelo"
        propertyToDisplay="name"
        propertyValue="id"
        url={route(APIRoutes.CAR_MODEL_LIST)}
        searchProperties={['name']}
        name="models"
        disabled={!data.brand}
        onChange={(e) => {
          setData('model', e as number);
        }}
        onCreate={handleCreateModel}
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
        unmaskedValueChange={(e) => {
          console.log({ e });
          setData('price', String(e));
        }}
        error={errors.price}
        required
        prefix={<span className="p-2 min-w-10 text-center bg-gray-50">R$</span>}
        mask="currency"
        max={999999.99}
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
        url={route(APIRoutes.COLOR_LIST)}
        searchProperties={['color']}
        value={data.color}
        onChange={(e) => setData('color', e as number)}
        onCreate={createColor}
        name="color"
        error={errors.color}
        required
      />
      <Autocomplete
        label="Tipo de combustível"
        propertyToDisplay="name"
        propertyValue="id"
        url={route(APIRoutes.FUEL_TYPE_LIST)}
        searchProperties={['name']}
        value={data.fuelType}
        onChange={(e) => setData('fuelType', e as number)}
        onCreate={createFuelType}
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
        url={route(APIRoutes.CAR_TRANSMISSION_LIST)}
        searchProperties={['name']}
        value={data.transmission}
        onChange={(e) => setData('transmission', e as number)}
        onCreate={createTransmission}
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
        maxFiles={10}
        className="md:col-span-2"
        onChange={(files) => setData('images', files)}
        onDelete={(files) => handleDeleteFile(files.id)}
        error={errors.images}
        files={selectedFiles}
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
        url={route(APIRoutes.CAR_OPTIONALS_LIST)}
        searchProperties={['name']}
        value={data.optionals}
        onChange={(e) => setData('optionals', e as number[])}
        onCreate={createOptional}
        name="optionals"
        className={'md:col-span-2'}
        moreThanOne
        error={errors.optionals}
      />
      <div className="col-span-full flex justify-end">
        <Button type="submit">Salvar</Button>
      </div>
    </form>
  );
};
