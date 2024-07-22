import { DefaultModel } from './DefaultModel';

export class Transmission extends DefaultModel {
  static ROUTE = 'transmissions';
  id?: number;
  name?: string;
}
