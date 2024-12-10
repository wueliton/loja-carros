import { Card } from '@/Components/Card';
import { CarIcon } from '@/Components/Icons/Car';
import { MotoIcon } from '@/Components/Icons/Moto';
import { InfoBlockMessage } from '@/Components/InfoBlockMessage';
import { Timeline } from '@/Components/Timeline';
import { useUser } from '@/Context/User';
import { CustomLog } from '@/models/Logs';
import { Head } from '@inertiajs/react';
import { useMemo } from 'react';
import { VehicleLimit } from './components/VehicleLimit';
import { VisitsPerVehicle } from './components/VisitsPerVehicle';
import { DashboardProps } from './types';

export default function Dashboard({
  auth,
  logs,
  cars,
  motorcycles,
  store,
}: DashboardProps) {
  const parsedLogs = useMemo<CustomLog[]>(() => {
    return logs.map((log) => JSON.parse(log.description ?? ''));
  }, [logs]);
  const { stores } = useUser();

  return (
    <>
      <Head title="Dashboard" />
      <div className="p-2 pt-0 pl-4 mb-10 mt-4">
        <h2 className="text-3xl font-bold">Olá, {auth.user.name}</h2>
        <p className="text-slate-500">
          Gerencie os veículos anunciados em sua loja.
        </p>
      </div>

      <div className="flex gap-4 flex-col">
        {store ? (
          <>
            <div className="flex gap-4 mb-4">
              <VehicleLimit
                title="Carros Anunciados"
                max={cars.limit}
                used={cars.registerCount}
                icon={<CarIcon />}
              />
              <VehicleLimit
                title="Motos Anunciadas"
                max={motorcycles.limit}
                used={motorcycles.registerCount}
                icon={<MotoIcon />}
              />
            </div>
            <div className="flex flex-col gap-4">
              <VisitsPerVehicle
                vehicles={[
                  ...cars.moreVisited.map((car) => ({ ...car, type: 'carro' })),
                  ...motorcycles.moreVisited.map((moto) => ({
                    ...moto,
                    type: 'moto',
                  })),
                ]}
              />
            </div>
          </>
        ) : null}
        {stores?.length ? null : (
          <InfoBlockMessage variant="important">
            <div>
              <h2 className="text-lg font-bold">Nenhuma loja cadastrada</h2>
              <p>
                Você não possui acesso a nenhuma loja cadastrada, contate o
                administrador.
              </p>
            </div>
          </InfoBlockMessage>
        )}

        <Card>
          <h2 className="text-xl font-bold mb-4">Minhas Atividades</h2>
          <Timeline logs={parsedLogs} />
        </Card>
      </div>
    </>
  );
}
