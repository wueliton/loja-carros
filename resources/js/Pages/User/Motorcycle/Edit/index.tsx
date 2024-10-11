import { Card } from '@/Components/Card';
import { Head } from '@/Components/Head';
import { UserRoutes } from '@/constants';
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
    images: [],
  };

  return (
    <>
      <Head
        title={`Editar ${motorcycle.title}`}
        breadcrumb={[{ title: 'Motos', url: route(UserRoutes.MOTO_LIST) }]}
      />
      <Card>
        <MotorcycleForm
          postUrl={route(UserRoutes.MOTO_EDIT, { id: motorcycle.id })}
          defaultValues={defaultValues}
          images={motorcycle.images}
        />
      </Card>
    </>
  );
}
