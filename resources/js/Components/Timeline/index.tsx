import { ACTION, CustomLog } from '@/models/Logs';
import moment from 'moment';
import { FC } from 'react';
import styles from './Timeline.module.scss';

export const Timeline: FC<{ logs: CustomLog[] }> = ({ logs }) => {
  return (
    <ol className={styles['timeline']}>
      {logs.length ? (
        logs.map((log, index) => (
          <li key={index}>
            <span className={styles['avatar']}>
              {log.user?.charAt(0) ?? 'A'}
            </span>
            <h3>
              <span className={styles['username']}>{log.user}</span>{' '}
              {ACTION[log.event]} o registro{' '}
              <span className={styles['chip']}>{log.title}</span> em {log.model}
            </h3>
            <time>
              {moment.duration(moment().diff(log.created_at)).humanize()}
            </time>
          </li>
        ))
      ) : (
        <li>Nennhuma atividade registrada.</li>
      )}
    </ol>
  );
};
