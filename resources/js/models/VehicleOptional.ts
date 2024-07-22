import { DefaultModel } from './DefaultModel';

export class VehicleOptional extends DefaultModel {
  static ROUTE = 'optional';
  id?: number;
  name?: string;
}
