import { Link } from '@inertiajs/react';
import { forwardRef } from 'react';
import ApplicationLogo from '../ApplicationLogo';
import { DashboardIcon } from '../Icons/Dashboard';
import { StoreIcon } from '../Icons/Store';
import { UsersIcon } from '../Icons/Users';
import styles from './Nav.module.scss';
import { NavLink } from './NavLink';

export const NavComponent = forwardRef<HTMLElement, { opened: boolean }>(
  ({ opened }, ref) => {
    return (
      <nav ref={ref} className={`${styles.nav} ${opened ? styles.opened : ''}`}>
        <Link href="/" className={styles['logo-link']}>
          <ApplicationLogo className={styles.logo} />
        </Link>
        <div className={styles.links}>
          <NavLink href="dashboard">
            <DashboardIcon /> Dashboard
          </NavLink>
          {route().has('users') && (
            <NavLink href="users">
              <UsersIcon /> Usuários
            </NavLink>
          )}
          {route().has('stores') && (
            <NavLink href="stores">
              <StoreIcon /> Lojas
            </NavLink>
          )}
          {/* <NavLink href="cars">
            <StoreIcon /> Veículos
          </NavLink> */}
        </div>
      </nav>
    );
  },
);
