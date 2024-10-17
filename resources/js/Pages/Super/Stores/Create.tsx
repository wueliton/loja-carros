import { Card } from '@/Components/Card';
import { Head } from '@/Components/Head';
import { SuperRoutes } from '@/constants';
import { PageProps } from '@/types';
import { StoreForm } from './components/StoreForm';

export default function CreateStorePage({}: PageProps) {
  return (
    <>
      <Head
        title="Nova Loja"
        breadcrumb={[
          { title: 'Lojas', url: route(SuperRoutes.STORE_LIST_VIEW) },
        ]}
      ></Head>
      <Card>
        <StoreForm postUrl={SuperRoutes.STORE_CREATE} />
      </Card>
    </>
  );
}
