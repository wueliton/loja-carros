import { AdminRoutes, SuperRoutes, UserRoutes } from '@/constants';
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
import { MenuCategory, MenuItem } from './index';

export const CommonMenu: (MenuItem | MenuCategory)[] = [
  {
    url: UserRoutes.CAR_LIST,
    icon: <CarIcon />,
    title: 'Carros',
  },
  {
    url: UserRoutes.MOTO_LIST,
    icon: <MotoqueiroIcon />,
    title: 'Motos',
  },
  {
    category: 'Config. Gerais',
  },
  {
    title: 'Marcas',
    url: AdminRoutes.BRANDS_LIST,
    icon: <CarIcon />,
  },
  {
    title: 'Tipos de Combustível',
    url: AdminRoutes.FUEL_TYPES_LIST,
    icon: <FuelPumpIcon />,
  },
  {
    title: 'Cores',
    url: AdminRoutes.COLORS_LIST,
    icon: <ColorsIcon />,
  },
  {
    category: 'Carros',
  },
  {
    url: AdminRoutes.CAR_MODELS_LIST,
    icon: <CarIcon />,
    title: 'Modelos',
  },
  {
    url: AdminRoutes.CAR_TRANSMISSIONS_LIST,
    icon: <CambioIcon />,
    title: 'Tipos de Câmbio',
  },
  {
    url: AdminRoutes.CAR_OPTIONALS_LIST,
    icon: <CarFrontIcon />,
    title: 'Opcionais',
  },
  {
    category: 'Motos',
  },
  {
    url: AdminRoutes.MOTO_MODELS_LIST,
    icon: <MotoIcon />,
    title: 'Modelos',
  },
  {
    url: AdminRoutes.MOTO_OPTIONALS_LIST,
    icon: <CapaceteIcon />,
    title: 'Opcionais',
  },
  {
    url: AdminRoutes.MOTO_TYPES_LIST,
    icon: <BisIcon />,
    title: 'Tipos',
  },
];

export const AdminMenu: (MenuItem | MenuCategory)[] = [
  {
    title: 'Dashboard',
    url: AdminRoutes.DASHBOARD,
    icon: <DashboardIcon />,
  },
  {
    category: 'Administrador',
  },
  {
    title: 'Usuários',
    url: AdminRoutes.USERS_LIST_VIEW,
    icon: <UsersIcon />,
  },
  {
    title: 'Loja',
    url: AdminRoutes.EDIT_STORE_VIEW,
    icon: <StoreIcon />,
  },
  ...CommonMenu,
];

export const RegularMenu: (MenuItem | MenuCategory)[] = [
  {
    title: 'Dashboard',
    url: UserRoutes.DASHBOARD,
    icon: <DashboardIcon />,
  },
  {
    title: 'Loja',
    url: UserRoutes.STORE_VIEW,
    icon: <StoreIcon />,
  },
  {
    category: 'Carros',
  },
  {
    url: UserRoutes.CAR_LIST,
    icon: <CarIcon />,
    title: 'Carros',
  },
  {
    category: 'Motos',
  },
  {
    url: UserRoutes.MOTO_LIST,
    icon: <MotoqueiroIcon />,
    title: 'Motos',
  },
];

export const SuperMenu: (MenuItem | MenuCategory)[] = [
  {
    title: 'Dashboard',
    url: SuperRoutes.DASHBOARD,
    icon: <DashboardIcon />,
  },
  {
    title: 'Lojas',
    url: SuperRoutes.STORE_LIST_VIEW,
    icon: <StoreIcon />,
  },
  {
    title: 'Usuários',
    url: SuperRoutes.USERS_LIST_VIEW,
    icon: <UsersIcon />,
  },
  {
    category: 'Config. Gerais',
  },
  {
    title: 'Marcas',
    url: AdminRoutes.BRANDS_LIST,
    icon: <CarIcon />,
  },
  {
    title: 'Tipos de Combustível',
    url: AdminRoutes.FUEL_TYPES_LIST,
    icon: <FuelPumpIcon />,
  },
  {
    title: 'Cores',
    url: AdminRoutes.COLORS_LIST,
    icon: <ColorsIcon />,
  },
  {
    category: 'Carros',
  },
  {
    url: SuperRoutes.CAR_LIST_VIEW,
    icon: <CarIcon />,
    title: 'Carros',
  },
  {
    url: AdminRoutes.CAR_MODELS_LIST,
    icon: <CarIcon />,
    title: 'Modelos',
  },
  {
    url: AdminRoutes.CAR_TRANSMISSIONS_LIST,
    icon: <CambioIcon />,
    title: 'Tipos de Câmbio',
  },
  {
    url: AdminRoutes.CAR_OPTIONALS_LIST,
    icon: <CarFrontIcon />,
    title: 'Opcionais',
  },
  {
    category: 'Motos',
  },
  {
    url: SuperRoutes.MOTORCYCLE_LIST_VIEW,
    icon: <MotoqueiroIcon />,
    title: 'Motos',
  },
  {
    url: AdminRoutes.MOTO_MODELS_LIST,
    icon: <MotoIcon />,
    title: 'Modelos',
  },
  {
    url: AdminRoutes.MOTO_OPTIONALS_LIST,
    icon: <CapaceteIcon />,
    title: 'Opcionais',
  },
  {
    url: AdminRoutes.MOTO_TYPES_LIST,
    icon: <BisIcon />,
    title: 'Tipos',
  },
];

export const menus = {
  super: SuperMenu,
  admin: AdminMenu,
  regular: RegularMenu,
};
