import { FC } from 'react';
import styles from './Divider.module.scss';

export const Divider: FC = () => {
  return <hr className={styles.divider} />;
};
