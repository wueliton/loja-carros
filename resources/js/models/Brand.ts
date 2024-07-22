import { DefaultModel } from './DefaultModel';

export class Brand extends DefaultModel {
  static ROUTE = 'brands';
  id?: number;
  name?: string;
}
