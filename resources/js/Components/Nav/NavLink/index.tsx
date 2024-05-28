import { InertiaLinkProps, Link, usePage } from '@inertiajs/react';
import { FC, useCallback } from 'react';
import styles from './NavLink.module.scss';

export const NavLink: FC<InertiaLinkProps> = ({
  className = '',
  children,
  href,
  ...props
}) => {
  const { url } = usePage();
  const active = useCallback(() => url.startsWith(`/${href}`), [url]);

  return (
    <Link
      href={route(href)}
      {...props}
      className={`${className} ${styles.link} ${active() ? styles.active : ''}`}
    >
      {children}
    </Link>
  );
};
