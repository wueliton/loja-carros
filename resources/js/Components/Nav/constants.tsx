import { AdminRouter } from '@/Routes/app.router';
import { MotorcycleBrandModels } from '@/models/MotorcycleBrandModels';
import { MotorcycleOptional } from '@/models/MotorcycleOptional';
import { MotorcycleTypes } from '@/models/MotorcycleTypes';
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

export const AdminMenu: (MenuItem | MenuCategory)[] = [
  {
    title: 'Dashboard',
    url: AdminRouter.DASHBOARD,
    icon: <DashboardIcon />,
  },
  {
    category: 'Administrador',
  },
  {
    title: 'Usuários',
    url: AdminRouter.USERS,
    icon: <UsersIcon />,
  },
  {
    title: 'Loja',
    url: AdminRouter.EDIT_STORE,
    icon: <StoreIcon />,
  },
  ...CommonMenu,
];

export const RegularMenu: (MenuItem | MenuCategory)[] = [
  {
    title: 'Dashboard',
    url: AdminRouter.DASHBOARD,
    icon: <DashboardIcon />,
  },
  {
    title: 'Loja',
    url: AdminRouter.EDIT_STORE,
    icon: <StoreIcon />,
  },
  {
    category: 'Carros',
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
    url: 'motorcycle',
    icon: <MotoqueiroIcon />,
    title: 'Motos',
  },
];
