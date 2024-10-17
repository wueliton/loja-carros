import { DefaultModel } from './DefaultModel';

export class Store extends DefaultModel {
  static ROUTE = 'stores';
  id?: number;
  name?: string;
  logo_url?: string;
  store_number?: string;
  email?: string;
  phone?: number;
  whatsapp?: number;
  instagram?: string;
  facebook?: string;
  site?: string;
}
