import { Car } from '@/models/Car';
import { CarFormSchema } from '../../types';

export interface UseCarFormProps {
  postUrl: string;
  defaultValues?: CarFormSchema;
  images?: Car['images'];
}
