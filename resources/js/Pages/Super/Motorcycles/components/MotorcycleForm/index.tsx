import { Button } from '@/Components/Button';
import { Autocomplete } from '@/Components/Forms/Autocomplete';
import { Checkbox } from '@/Components/Forms/Checkbox';
import { Editor } from '@/Components/Forms/Editor';
import { Input } from '@/Components/Forms/Input';
import { UploadFile } from '@/Components/Forms/UploadFile';
import { APIRoutes } from '@/constants';
import { FC } from 'react';
import { useMotorcycleForm } from './hooks/useMotorcycleForm';
import { MotorcycleFormProps } from './types';

export const MotorcycleForm: FC<MotorcycleFormProps> = ({
  defaultValues,
  postUrl,
  images,
  showCode,
}) => {
  const {
    onSubmit,
    data,
    setData,
    errors,
    selectedFiles,
    currentYear,
    commonService,
    motorcycleService,
    optionalList,
    handleOptionalsChange,
    handleCreateModel,
    handleDeleteFile,
  } = useMotorcycleForm({ defaultValues, postUrl, images });
  const { createBrand, createColor } = commonService;
  const { createType } = motorcycleService;

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

      {showCode ? (
        <>
          <Input label="Slug" value={defaultValues?.slug} readOnly />
          <Input label="Código" value={defaultValues?.code} readOnly />
        </>
      ) : null}

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
        error={errors.color}
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
        error={errors.brand}
        onChange={(e) =>
          setData({
            ...data,
            brand: e as number,
            model: undefined,
          })
        }
        onCreate={createBrand}
        name="brand"
        required
      />
      <Autocomplete
        label="Modelo"
        propertyToDisplay="name"
        propertyValue="id"
        url={route(APIRoutes.MOTO_MODEL_LIST)}
        searchProperties={['name']}
        name="models"
        disabled={!data.brand}
        onChange={(e) => setData('model', e as number)}
        error={errors.model}
        filter={[
          {
            fieldName: 'brand_id',
            comparison: 'equals',
            value: data.brand,
          },
        ]}
        onCreate={handleCreateModel}
        value={data.model}
        required
      />
      <Autocomplete
        label="Tipo"
        propertyToDisplay="name"
        propertyValue="id"
        url={route(APIRoutes.MOTO_TYPES_LIST)}
        searchProperties={['name']}
        name="type"
        onChange={(e) => setData('type', e as number)}
        onCreate={createType}
        value={data.type}
        error={errors.type}
        required
      />
      <Input
        label="Valor"
        value={data.price}
        unmaskedValueChange={(e) => setData('price', String(e))}
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
        url={route(APIRoutes.COLOR_LIST)}
        searchProperties={['color']}
        value={data.color}
        onChange={(e) => setData('color', e as number)}
        onCreate={createColor}
        name="color"
        error={errors.color}
        required
      />
      <h2 className="md:col-span-2 text-lg font-bold mt-4">Imagens</h2>
      <UploadFile
        hint="JPG, PNG, WEBP ou GIF (Max 1MB)"
        fieldName="Logo da Empresa"
        accept="image/png, image/jpg, image/webp, image/jpeg"
        maxFiles={10}
        className="md:col-span-2"
        onChange={(files) =>
          setData(
            'images',
            files?.map(({ fileName }) => ({ url: fileName! })),
          )
        }
        error={errors.images}
        files={selectedFiles}
        onDelete={(file) => handleDeleteFile(file.id)}
        url="api.motorcycle.images.upload"
        isMultiple
      />
      <h2 className="md:col-span-2 text-lg font-bold mt-4">Observações</h2>
      <Editor
        className="md:col-span-2"
        value={data.details}
        onChange={(data) => setData('details', data)}
        error={errors.details}
      />
      <h2 className="md:col-span-2 text-lg font-bold mt-4">Opcionais</h2>
      <div className="grid grid-cols-2 md:grid-cols-4 gap-6 md:col-span-2">
        {optionalList.map((optional, index) => (
          <Checkbox
            key={index}
            defaultChecked={defaultValues?.optionals?.includes(optional.id!)}
            onChange={(e) => handleOptionalsChange(e, Number(optional.id))}
          >
            {optional.name}
          </Checkbox>
        ))}
      </div>
      <div className="col-span-full flex justify-end">
        <Button type="submit">Salvar</Button>
      </div>
    </form>
  );
};
