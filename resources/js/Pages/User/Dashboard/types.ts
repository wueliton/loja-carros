import { Logs } from '@/models/Logs';
import { Store } from '@/models/Store';
import { PageProps } from '@/types';

interface VehicleProps {
  id: number;
  slug: string;
  title: string;
  visits: number;
}

interface VehicleReport {
  limit: number;
  registerCount: number;
  moreVisited: VehicleProps[];
}

interface DashboardProps extends PageProps {
  logs: Logs[];
  cars: VehicleReport;
  motorcycles: VehicleReport;
  store?: Store | null;
}

export type { DashboardProps };
