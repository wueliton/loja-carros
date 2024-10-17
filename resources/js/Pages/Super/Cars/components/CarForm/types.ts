import { Car } from '@/models/Car';

export interface CarFormProps {
  postUrl: string;
  defaultValues?: CarFormSchema;
  images?: Car['images'];
}

export interface CarFormSchema {
  title?: string;
  storeId?: number;
  brand?: number;
  model?: number;
  manufacturingYear?: number;
  year?: number;
  version?: string;
  price?: string;
  color?: number;
  fuelType?: number;
  doors?: number;
  transmission?: number;
  motor?: string;
  km?: number;
  lastDigit?: number;
  optionals?: (number | undefined)[];
  images?: File[];
  details?: string;
}
