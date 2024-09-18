import { useUser } from '@/Context/User';
import { Link } from '@inertiajs/react';
import { Fragment, ReactNode, forwardRef, useMemo } from 'react';
import ApplicationLogo from '../ApplicationLogo';
import { Divider } from '../Divider';
import { HasRole } from '../HasRole';
import styles from './Nav.module.scss';
import { NavLink } from './NavLink';
import { StoreSelection } from './StoreSelection';
import { AdminMenu, RegularMenu } from './constants';

export type MenuCategory = {
  category: string;
};

export type MenuItem = {
  title: string;
  icon: ReactNode;
  url: string;
  hasRole?: string;
};

export const NavComponent = forwardRef<
  HTMLElement,
  {
    opened: boolean;
    setOpened: (opened: boolean) => void;
  }
>(({ opened, setOpened }, ref) => {
  const { stores, lastStore, roles } = useUser();
  const menu = useMemo(
    () => (roles?.includes('admin') ? AdminMenu : RegularMenu),
    [],
  );

  return (
    <nav
      ref={ref}
      className={`${styles.nav} ${opened ? styles.opened : ''}`}
      scroll-region="true"
    >
      <Link href={route('dashboard')} className={styles['logo-link']}>
        <ApplicationLogo className={styles.logo} />
      </Link>

      <StoreSelection />

      {!!stores?.length && lastStore && (
        <>
          <Divider />

          <div className={styles.links}>
            {menu.map((item, key) => {
              if ((item as MenuCategory).category)
                return (
                  <div className={styles.category} key={key}>
                    {(item as MenuCategory).category}
                  </div>
                );
              item = item as MenuItem;
              if (route().has(item.url))
                return (
                  <HasRole key={key} role={item.hasRole}>
                    <NavLink
                      href={item.url}
                      preserveScroll
                      onClick={() => setOpened(false)}
                    >
                      {item.icon} {item.title}
                    </NavLink>
                  </HasRole>
                );
              return <Fragment key={key}></Fragment>;
            })}
          </div>
        </>
      )}
    </nav>
  );
});
