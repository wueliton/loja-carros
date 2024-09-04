import { useUser } from '@/Context/User';
import { MotorcycleBrandModels } from '@/models/MotorcycleBrandModels';
import { MotorcycleOptional } from '@/models/MotorcycleOptional';
import { MotorcycleTypes } from '@/models/MotorcycleTypes';
import { Link } from '@inertiajs/react';
import { Fragment, ReactNode, forwardRef } from 'react';
import ApplicationLogo from '../ApplicationLogo';
import { Divider } from '../Divider';
import { HasRole } from '../HasRole';
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
import { StoreSelection } from './StoreSelection';

export type MenuCategory = {
  category: string;
};

export type MenuItem = {
  title: string;
  icon: ReactNode;
  url: string;
  hasRole?: string;
};

const getMenu = (): (MenuItem | MenuCategory)[] => [
  {
    title: 'Dashboard',
    url: 'dashboard',
    icon: <DashboardIcon />,
  },
  {
    title: 'Usuários',
    url: 'users',
    icon: <UsersIcon />,
    hasRole: 'admin',
  },
  {
    title: 'Lojas',
    url: 'stores',
    icon: <StoreIcon />,
    hasRole: 'super',
  },
  {
    title: 'Loja',
    url: 'admin.store',
    icon: <StoreIcon />,
    hasRole: 'admin',
  },
  {
    category: 'Config. Gerais',
  },
  {
    title: 'Marcas',
    url: 'brands',
    icon: <CarIcon />,
  },
  {
    title: 'Tipos de Combustível',
    url: 'fuelTypes',
    icon: <FuelPumpIcon />,
  },
  {
    title: 'Cores',
    url: 'colors',
    icon: <ColorsIcon />,
  },
  {
    category: 'Carros',
  },
  {
    url: 'brandModels',
    icon: <CarIcon />,
    title: 'Modelos',
  },
  {
    url: 'transmissions',
    icon: <CambioIcon />,
    title: 'Tipos de Câmbio',
  },
  {
    url: 'optional',
    icon: <CarFrontIcon />,
    title: 'Opcionais',
  },
  {
    url: 'cars',
    icon: <CarIcon />,
    title: 'Carros',
  },
  {
    category: 'Motos',
  },
  {
    url: MotorcycleBrandModels.GET_ROUTE(),
    icon: <MotoIcon />,
    title: 'Modelos',
  },
  {
    url: MotorcycleOptional.GET_ROUTE(),
    icon: <CapaceteIcon />,
    title: 'Opcionais',
  },
  {
    url: MotorcycleTypes.GET_ROUTE(),
    icon: <BisIcon />,
    title: 'Tipos',
  },
  {
    url: 'motorcycle',
    icon: <MotoqueiroIcon />,
    title: 'Motos',
  },
];

export const NavComponent = forwardRef<
  HTMLElement,
  {
    opened: boolean;
    setOpened: (opened: boolean) => void;
  }
>(({ opened, setOpened }, ref) => {
  const { stores, lastStore } = useUser();

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
            {getMenu().map((item, key) => {
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
