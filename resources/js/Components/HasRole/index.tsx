import { useUser } from '@/Context/User';
import { FC, PropsWithChildren } from 'react';

export const HasRole: FC<PropsWithChildren<{ role?: string }>> = ({
  children,
  role,
}) => {
  const { hasRole } = useUser();

  if (!role || hasRole(role)) return <>{children}</>;
  return <></>;
};
