import { MotorcycleBrandModels } from '@/models/MotorcycleBrandModels';
import { MotorcycleOptional } from '@/models/MotorcycleOptional';
import { MotorcycleTypes } from '@/models/MotorcycleTypes';
import { Link } from '@inertiajs/react';
import { forwardRef } from 'react';
import ApplicationLogo from '../ApplicationLogo';
import { BisIcon } from '../Icons/Bis';
import { CambioIcon } from '../Icons/Cambio';
import { CapaceteIcon } from '../Icons/Capacete';
import { CarIcon } from '../Icons/Car';
import { CarFrontIcon } from '../Icons/CarFront';
import { ColorsIcon } from '../Icons/Colors';
import { DashboardIcon } from '../Icons/Dashboard';
import { FuelPumpIcon } from '../Icons/FuelPump';
import { MotoIcon } from '../Icons/Moto';
import { MotoqueiroIcon } from '../Icons/Motoqueiro';
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
          <div className={styles.category}>Config. Gerais</div>
          <NavLink href="colors">
            <ColorsIcon /> Cores
          </NavLink>
          <NavLink href="fuelTypes">
            <FuelPumpIcon /> Tipos de Combustível
          </NavLink>
          <NavLink href="brands">
            <CarIcon /> Marcas
          </NavLink>
          <div className={styles.category}>Carros</div>
          <NavLink href="brandModels">
            <CarIcon /> Modelos
          </NavLink>
          <NavLink href="transmissions">
            <CambioIcon /> Tipos de Câmbio
          </NavLink>
          <NavLink href="optional">
            <CarFrontIcon /> Opcionais
          </NavLink>
          <NavLink preserveScroll href="cars">
            <CarIcon /> Carros
          </NavLink>
          <div className={styles.category}>Motos</div>
          <NavLink href={MotorcycleBrandModels.GET_ROUTE()}>
            <MotoIcon /> Modelos
          </NavLink>
          <NavLink preserveScroll href={MotorcycleOptional.GET_ROUTE()}>
            <CapaceteIcon /> Opcionais
          </NavLink>
          <NavLink preserveScroll href={MotorcycleTypes.GET_ROUTE()}>
            <BisIcon /> Tipos
          </NavLink>
          <NavLink preserveScroll href="motorcycle">
            <MotoqueiroIcon /> Motos
          </NavLink>
        </div>
      </nav>
    );
  },
);
