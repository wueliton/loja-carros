import { Brand } from './Brand';
import { Color } from './Color';
import { DefaultModel } from './DefaultModel';
import { FuelType } from './FuelType';
import { Model } from './Model';
import { Transmission } from './Transmission';
import { CarOptional } from './VehicleOptional';

export class Car extends DefaultModel {
  static ROUTE = 'cars';
  id?: string;
  title?: string;
  brand_id?: number;
  brand?: Brand;
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
  seats?: number;
  power?: string;
  size?: string;
  fuel_capacity?: number;
  axis_length?: string;
  images?: { id?: number; url?: string }[];
  optionals?: CarOptional[];
  created_at?: string;
}