import { FC, PropsWithChildren } from 'react';
import styles from './Header.module.scss';

export const DialogHeader: FC<PropsWithChildren> = ({ children }) => {
  return <div className={styles['dialog-header']}>{children}</div>;
};
