import { Car } from '@/models/Car';

export interface CarFormProps {
  postUrl: string;
  defaultValues?: CarFormSchema;
  images?: Car['images'];
  showCode?: boolean;
}

export interface CarFormSchema {
  title?: string;
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
  images?: { url: string }[];
  details?: string;
  slug?: string;
  code?: string;
}
