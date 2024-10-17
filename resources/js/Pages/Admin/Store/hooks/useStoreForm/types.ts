import { Store } from '@/models/Store';

export interface UseStoreFormProps {
  store: Store & { users_ids: number[] };
  postRoute: string;
}
