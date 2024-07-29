import { DefaultModel } from './DefaultModel';

export class CarOptional extends DefaultModel {
  static ROUTE = 'optional';
  id?: number;
  name?: string;
}
