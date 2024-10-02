import { Store } from '@/models/Store';

export interface UseStoreFormProps {
  store: Store;
}

export interface StoreSchema {
  name?: string;
  logo_url?: File;
  store_number?: string;
  email?: string;
  phone?: string | number;
  whatsapp?: string | number;
}
