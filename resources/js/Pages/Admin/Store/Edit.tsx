import { Head } from '@/Components/Head';
import StoreEdit from '@/Entities/Store/EditStore';
import { AdminRouter } from '@/Routes/app.router';
import { Store } from '@/models/Store';
import { PageProps } from '@/types';

const AdminEditStorePage = ({
  store,
}: PageProps<{ store: Store & { users_ids: number[] } }>) => {
  return (
    <>
      <Head title={`Editar ${store.name}`} />
      <StoreEdit
        store={store}
        postRoute={route(AdminRouter.REQ_UPDATE_STORE)}
      />
    </>
  );
};

export default AdminEditStorePage;
