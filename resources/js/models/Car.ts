import { Brand } from './Brand';
import { Color } from './Color';
import { DefaultModel } from './DefaultModel';
import { FuelType } from './FuelType';
import { Model } from './Model';
import { Store } from './Store';
import { Transmission } from './Transmission';
import { CarOptional } from './VehicleOptional';

export class Car extends DefaultModel {
  static ROUTE = 'cars';
  id?: string;
  title?: string;
  brand_id?: number;
  brand?: Brand;
  store_id?: number;
  store?: Store;
  model_id?: number;
  model?: Model;
  manufacturing_year?: number;
  year?: number;
  version?: string;
  color_id?: number;
  color?: Color;
  fuel_type_id?: number;
  fuel_type?: FuelType;
  doors?: number;
  transmission_id?: number;
  transmission?: Transmission;
  motor?: string;
  km?: number;
  last_digit?: number;
  details?: string;
  images?: { id?: number; url?: string; order?: number }[];
  optionals?: CarOptional[];
  created_at?: string;
}
