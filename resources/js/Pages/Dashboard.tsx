import { Card } from '@/Components/Card';
import { Head } from '@/Components/Head';
import { AuthenticatedLayout } from '@/Layouts/Authenticated';
import { ACTION, CustomLog, Logs } from '@/models/Logs';
import { PageProps } from '@/types';
import moment from 'moment';
import { useMemo } from 'react';

export default function Dashboard({ auth, logs }: PageProps<{ logs: Logs[] }>) {
  const parsedLogs = useMemo<CustomLog[]>(() => {
    return logs.map((log) => JSON.parse(log.description ?? ''));
  }, [logs]);

  return (
    <AuthenticatedLayout user={auth.user} head={<Head title="Dashboard" />}>
      <Card>
        <>
          {parsedLogs.map((log) => (
            <div>
              {ACTION[log.event]} o registro {log.title} em {log.model} •{' '}
              {moment.duration(moment().diff(log.created_at)).humanize()}.
            </div>
          ))}
        </>
      </Card>
    </AuthenticatedLayout>
  );
}
