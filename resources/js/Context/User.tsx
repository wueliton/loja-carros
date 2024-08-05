import { User } from '@/types';
import { FC, PropsWithChildren, createContext, useContext } from 'react';

export interface UserContext {
  user?: User;
  roles?: string[];
  hasRole: (role: string) => boolean;
}

const UserContext = createContext<UserContext>({} as UserContext);

export const UserProvider: FC<
  PropsWithChildren<{ user?: User; roles?: string[] }>
> = ({ children, user, roles }) => {
  const handleHasRole = (role: string) => (roles ?? []).includes(role);

  return (
    <UserContext.Provider value={{ user, roles, hasRole: handleHasRole }}>
      {children}
    </UserContext.Provider>
  );
};

export const useUser = () => {
  return useContext(UserContext);
};
