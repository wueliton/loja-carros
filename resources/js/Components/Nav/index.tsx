import { Link } from '@inertiajs/react';
import { FC } from 'react';
import ApplicationLogo from '../ApplicationLogo';
import { DashboardIcon } from '../Icons/Dashboard';
import { StoreIcon } from '../Icons/Store';
import { UsersIcon } from '../Icons/Users';
import styles from './Nav.module.scss';
import { NavLink } from './NavLink';

export const NavComponent: FC = () => {
  return (
    <nav className={`${styles.nav}`}>
      <Link href="/" className={styles['logo-link']}>
        <ApplicationLogo className={styles.logo} />
      </Link>
      <div className={styles.links}>
        <NavLink href="dashboard">
          <DashboardIcon /> Dashboard
        </NavLink>
        <NavLink href="users">
          <UsersIcon /> Usuários
        </NavLink>
        <NavLink href="stores">
          <StoreIcon /> Lojas
        </NavLink>
      </div>
    </nav>
  );
};
