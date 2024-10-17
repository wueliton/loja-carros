import { Role } from '@/models/Role';
import { User } from '@/types';

export interface UserFormProps {
  user?: User;
  roles: Role[];
  url: string;
}
