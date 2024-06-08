import { FC, PropsWithChildren } from 'react';
import styles from './Footer.module.scss';

export const DialogFooter: FC<PropsWithChildren> = ({ children }) => {
  return <div className={styles['dialog-footer']}>{children}</div>;
};
