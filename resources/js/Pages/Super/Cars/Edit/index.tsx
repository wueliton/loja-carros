import { Card } from '@/Components/Card';
import { Head } from '@/Components/Head';
import { SuperRoutes } from '@/constants';
import { Car } from '@/models/Car';
import { PageProps } from '@/types';
import { CarForm } from '../components/CarForm';
import { CarFormSchema } from '../components/CarForm/types';

export default function EditCarPage({ car }: PageProps<{ car: Car }>) {
  const defaultValues: CarFormSchema = {
    ...car,
    brand: car.brand_id,
    model: car.model_id,
    color: car.color_id,
    fuelType: car.fuel_type_id,
    transmission: car.transmission_id,
    optionals: car.optionals?.map((optional) => optional.id) ?? [],
    manufacturingYear: car.manufacturing_year,
    lastDigit: car.last_digit,
    storeId: car.store_id,
    images: [],
  };

  return (
    <>
      <Head
        title={`Editar ${car.title}`}
        breadcrumb={[
          { title: 'Carros', url: route(SuperRoutes.CAR_LIST_VIEW) },
        ]}
      />
      <Card>
        <CarForm
          postUrl={route(SuperRoutes.CAR_EDIT, { id: car.id })}
          defaultValues={defaultValues}
          images={car.images?.map((image) => ({
            ...image,
            fileName: image.url,
          }))}
        />
      </Card>
    </>
  );
}
