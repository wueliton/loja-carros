import { Brand } from './Brand';
import { Color } from './Color';
import { DefaultModel } from './DefaultModel';
import { MotorcycleBrandModels } from './MotorcycleBrandModels';
import { MotorcycleOptional } from './MotorcycleOptional';
import { MotorcycleTypes } from './MotorcycleTypes';

export class Motorcycle extends DefaultModel {
  static ROUTE = 'motorcycle';
  id?: string;
  title?: string;
  brand?: Brand;
  model?: MotorcycleBrandModels;
  type?: MotorcycleTypes;
  manufacturing_year?: number;
  year?: number;
  cylinder?: string;
  motor?: string;
  color?: Color;
  km?: number;
  fuel_capacity?: number;
  size?: string;
  axis_length?: string;
  optionals?: MotorcycleOptional[];
  images?: string[];
  details?: string;
  created_at?: string;
}
