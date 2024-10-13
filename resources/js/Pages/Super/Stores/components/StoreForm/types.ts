import { Store } from '@/models/Store';

export type StoreProps = Store & {
  users_ids: number[];
};

export interface StoreFormProps {
  store?: StoreProps;
  postUrl: string;
}
