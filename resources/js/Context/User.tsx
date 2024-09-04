import { Store } from '@/models/Store';
import { User } from '@/types';
import { FC, PropsWithChildren, createContext, useContext } from 'react';

export interface UserContext {
  user?: User;
  roles?: string[];
  stores?: Store[];
  lastStore?: number;
  hasRole: (role: string) => boolean;
}

const UserContext = createContext<UserContext>({} as UserContext);

export const UserProvider: FC<
  PropsWithChildren<{
    user?: User;
    roles?: string[];
    stores?: Store[];
    lastStore?: number;
  }>
> = ({ children, user, roles, stores, lastStore }) => {
  const handleHasRole = (role: string) => (roles ?? []).includes(role);

  return (
    <UserContext.Provider
      value={{ user, roles, stores, lastStore, hasRole: handleHasRole }}
    >
      {children}
    </UserContext.Provider>
  );
};

export const useUser = () => {
  return useContext(UserContext);
};
