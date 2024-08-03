import { Card } from '@/Components/Card';
import { Timeline } from '@/Components/Timeline';
import { CustomLog, Logs } from '@/models/Logs';
import { PageProps } from '@/types';
import { useMemo } from 'react';

export default function Dashboard({ auth, logs }: PageProps<{ logs: Logs[] }>) {
  const parsedLogs = useMemo<CustomLog[]>(() => {
    return logs.map((log) => JSON.parse(log.description ?? ''));
  }, [logs]);

  return (
    <>
      <div className="p-2 pt-0 pl-4 mb-10 mt-4">
        <h2 className="text-3xl font-bold">Olá, {auth.user.name}</h2>
        <p className="text-slate-500">
          Gerencie os veículos anunciados em sua loja.
        </p>
      </div>

      {/* <div className="flex gap-4 mb-4">
        <Card className="flex gap-4 items-center">
          <div className="rounded-full bg-slate-900 text-white p-2">
            <CarIcon />
          </div>
          <div>
            <h3 className="text-xl font-bold">34</h3>
            <p className="text-sm text-slate-400">Carros Anunciados</p>
          </div>
        </Card>
        <Card className="flex gap-4 items-center">
          <div className="rounded-full bg-slate-900 text-white p-2">
            <MotoIcon />
          </div>
          <div>
            <h3 className="text-xl font-bold">4</h3>
            <p className="text-sm text-slate-400">Motos Anunciadas</p>
          </div>
        </Card>
      </div> */}

      <Card>
        <h2 className="text-xl font-bold mb-4">Minhas Atividades</h2>
        <Timeline logs={parsedLogs} />
      </Card>
    </>
  );
}
