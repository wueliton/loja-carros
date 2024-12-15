import { Brand } from './Brand';
import { Color } from './Color';
import { DefaultModel } from './DefaultModel';
import { MotorcycleBrandModels } from './MotorcycleBrandModels';
import { MotorcycleOptional } from './MotorcycleOptional';
import { MotorcycleTypes } from './MotorcycleTypes';
import { Store } from './Store';

export class Motorcycle extends DefaultModel {
  static ROUTE = 'motorcycle';
  id?: string;
  title?: string;
  brand_id?: number;
  brand?: Brand;
  store_id?: number;
  store?: Store;
  model_id?: number;
  model?: MotorcycleBrandModels;
  type_id?: number;
  type?: MotorcycleTypes;
  manufacturing_year?: number;
  year?: number;
  cylinder?: string;
  motor?: string;
  color_id?: number;
  color?: Color;
  km?: number;
  optionals?: MotorcycleOptional[];
  images?: { id?: number; url?: string; order?: number }[];
  details?: string;
  created_at?: string;
}
