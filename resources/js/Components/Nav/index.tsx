import { Link } from '@inertiajs/react';
import { forwardRef } from 'react';
import ApplicationLogo from '../ApplicationLogo';
import { CambioIcon } from '../Icons/Cambio';
import { CarIcon } from '../Icons/Car';
import { ColorsIcon } from '../Icons/Colors';
import { DashboardIcon } from '../Icons/Dashboard';
import { FuelPumpIcon } from '../Icons/FuelPump';
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
          <div className={styles.category}>Config. de Veículos</div>
          <NavLink href="colors">
            <ColorsIcon /> Cores
          </NavLink>
          <NavLink href="fuelTypes">
            <FuelPumpIcon /> Tipos de Combustível
          </NavLink>
          <NavLink href="brands">
            <CarIcon /> Marcas
          </NavLink>
          <NavLink href="brandModels">
            <CarIcon /> Modelos
          </NavLink>
          <NavLink href="transmissions">
            <CambioIcon /> Tipos de Câmbio
          </NavLink>
          <div className={styles.category}>Veículos</div>
          <NavLink href="brandModels">
            <CarIcon /> Veículos
          </NavLink>
        </div>
      </nav>
    );
  },
);
