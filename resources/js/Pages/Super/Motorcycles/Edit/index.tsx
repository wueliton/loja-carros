import { Card } from '@/Components/Card';
import { Head } from '@/Components/Head';
import { SuperRoutes } from '@/constants';
import { Motorcycle } from '@/models/Motorcycle';
import { PageProps } from '@/types';
import { MotorcycleForm } from '../components/MotorcycleForm';
import { MotorcycleSchema } from '../components/MotorcycleForm/types';

export default function EditMotorcyclePage({
  motorcycle,
}: PageProps<{ motorcycle: Motorcycle }>) {
  const defaultValues: MotorcycleSchema = {
    ...motorcycle,
    brand: motorcycle.brand_id,
    model: motorcycle.model_id,
    type: motorcycle.type_id,
    color: motorcycle.color_id,
    optionals: motorcycle.optionals?.map((optional) => optional.id!),
    manufacturingYear: motorcycle.manufacturing_year,
    storeId: motorcycle.store_id,
    images: [],
  };

  return (
    <>
      <Head
        title={`Editar ${motorcycle.title}`}
        breadcrumb={[
          { title: 'Motos', url: route(SuperRoutes.MOTORCYCLE_LIST_VIEW) },
        ]}
      />
      <Card>
        <MotorcycleForm
          postUrl={route(SuperRoutes.MOTORCYCLE_EDIT, { id: motorcycle.id })}
          defaultValues={defaultValues}
          images={motorcycle.images}
          showCode
        />
      </Card>
    </>
  );
}
