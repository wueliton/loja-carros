import { Motorcycle } from '@/models/Motorcycle';
import { MotorcycleSchema } from '../../types';

export interface UseMotorcycleFormProps {
  postUrl: string;
  defaultValues?: MotorcycleSchema;
  images?: Motorcycle['images'];
}
