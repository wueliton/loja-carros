import { InertiaLinkProps, Link, usePage } from '@inertiajs/react';
import { FC, useCallback, useMemo } from 'react';
import styles from './NavLink.module.scss';

export const NavLink: FC<InertiaLinkProps> = ({
  className = '',
  children,
  href,
  ...props
}) => {
  const { url } = usePage();
  const link = useMemo(() => route(href), [href]);
  const active = useCallback(() => url.includes(new URL(link).pathname), [url]);

  return (
    <Link
      href={link}
      {...props}
      className={`${className} ${styles.link} ${active() ? styles.active : ''}`}
    >
      {children}
    </Link>
  );
};
