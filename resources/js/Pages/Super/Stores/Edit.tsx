import { Card } from '@/Components/Card';
import { Head } from '@/Components/Head';
import { SuperRoutes } from '@/constants';
import { PageProps } from '@/types';
import { StoreForm } from './components/StoreForm';
import { StoreProps } from './components/StoreForm/types';

export default function EditStore({ store }: PageProps<{ store: StoreProps }>) {
  console.log({ store });

  return (
    <>
      <Head
        title={`Editar ${store.name}`}
        breadcrumb={[
          { title: 'Lojas', url: route(SuperRoutes.STORE_LIST_VIEW) },
        ]}
      />
      <Card>
        <StoreForm store={store} postUrl={SuperRoutes.STORE_EDIT} />
      </Card>
    </>
  );
}
