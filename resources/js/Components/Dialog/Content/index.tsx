import { Button } from '@/Components/Button';
import { ExclamationCircleIcon } from '@/Components/Icons/ExclamationCircle';
import { FC, ReactElement } from 'react';
import styles from './Content.module.scss';

export interface DialogContentProps {
  title: string;
  content: string;
  icon?: ReactElement;
  data?: unknown;
}

export interface ActionsProps {
  close: (data?: unknown) => void;
}

export const DialogContent: FC<DialogContentProps & ActionsProps> = ({
  title,
  content,
  icon,
  data,
  close,
}) => {
  return (
    <div className={styles.content}>
      <>{icon ?? <ExclamationCircleIcon />}</>
      <h3>{title}</h3>
      <p>{content}</p>
      <div className={styles.actions}>
        <Button onClick={() => close(false)} variant="basic">
          Cancelar
        </Button>
        <Button onClick={() => close(data ?? true)} color="primary">
          OK
        </Button>
      </div>
    </div>
  );
};
