import { DefaultModel } from './DefaultModel';

export class FuelType extends DefaultModel {
  static ROUTE = 'fuelTypes';
  id?: number;
  name?: string;
}
