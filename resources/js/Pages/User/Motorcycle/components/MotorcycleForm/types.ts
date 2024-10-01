import { Motorcycle } from '@/models/Motorcycle';

export interface MotorcycleSchema {
  title?: string;
  brand?: number;
  price?: string;
  model?: number;
  type?: number;
  manufacturingYear?: number;
  year?: number;
  cylinder?: string;
  motor?: string;
  color?: number;
  km?: number;
  optionals?: number[];
  images?: File[];
  details?: string;
}

export interface MotorcycleFormProps {
  postUrl: string;
  defaultValues?: MotorcycleSchema;
  images?: Motorcycle['images'];
}
