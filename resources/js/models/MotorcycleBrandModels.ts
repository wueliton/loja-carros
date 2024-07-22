import { Brand } from './Brand';
import { DefaultModel } from './DefaultModel';

export class MotorcycleBrandModels extends DefaultModel {
  static ROUTE = 'motorcycleBrandModel';
  id?: number;
  name?: string;
  brand?: Brand;
}
