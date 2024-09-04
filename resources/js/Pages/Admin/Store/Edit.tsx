import { Head } from '@/Components/Head';
import StoreEdit from '@/Entities/Store/EditStore';
import { Store } from '@/models/Store';
import { PageProps } from '@/types';

const AdminEditStorePage = ({
  store,
}: PageProps<{ store: Store & { users_ids: number[] } }>) => {
  console.log(store);
  return (
    <>
      <Head title={`Editar ${store.name}`} />
      <StoreEdit store={store} postRoute={route('admin.store.update')} />
    </>
  );
};

export default AdminEditStorePage;
