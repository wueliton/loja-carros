import { Role } from '@/models/Role';
import { ReactElement } from 'react';
import { Config } from 'ziggy-js';

export interface User {
  id: number;
  name: string;
  email: string;
  email_verified_at: string;
  password?: string;
  roles: Role[];
  created_by: number;
}

export type PageProps<
  T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
  auth: {
    user: User;
  };
  head: () => ReactElement;
  ziggy: Config & { location: string };
};
