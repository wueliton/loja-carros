import { DefaultModel } from './DefaultModel';

export class Color extends DefaultModel {
  static ROUTE = 'colors';
  id?: number;
  color?: string;
}
