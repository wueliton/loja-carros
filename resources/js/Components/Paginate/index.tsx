import { Paginated } from '@/models/Paginated';
import { router } from '@inertiajs/react';
import { FC } from 'react';
import { IconButton } from '../IconButton';
import { ArrowLeftIcon } from '../Icons/ArrowLeft';
import { ArrowRightIcon } from '../Icons/ArrowRight';
import styles from './Paginate.module.scss';

export const Paginate: FC<
  Pick<
    Paginated<unknown>,
    'from' | 'to' | 'total' | 'next_page_url' | 'prev_page_url'
  >
> = ({ from, to, total, next_page_url, prev_page_url }) => {
  return (
    <div className={styles['paginator']}>
      <div>
        <span>
          {from ?? 0}-{to ?? 0}
        </span>{' '}
        de {total}
      </div>
      <div>
        <IconButton
          icon={<ArrowLeftIcon />}
          disabled={!prev_page_url}
          onClick={() => router.visit(prev_page_url!)}
        />
        <IconButton
          icon={<ArrowRightIcon />}
          disabled={!next_page_url}
          onClick={() => router.visit(next_page_url!)}
        />
      </div>
    </div>
  );
};
