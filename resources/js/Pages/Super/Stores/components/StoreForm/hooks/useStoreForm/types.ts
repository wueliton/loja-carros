import { StoreProps } from '../../types';

export interface UseStoreFormProps {
  store?: StoreProps;
  postUrl: string;
}

export interface StoreFormProps {
  logo_url?: string;
  name?: string;
  store_number?: string;
  email?: string;
  phone?: string | number;
  whatsapp?: string | number;
  users: number[];
  instagram?: string;
  facebook?: string;
  site?: string;
  max_cars?: number;
  max_motorcycles?: number;
}
