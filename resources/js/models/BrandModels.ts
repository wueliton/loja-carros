import { Brand } from './Brand';
import { DefaultModel } from './DefaultModel';

export class CarBrandModel extends DefaultModel {
  static ROUTE = 'brandModels';
  id?: number;
  name?: string;
  brand?: Brand;
}
