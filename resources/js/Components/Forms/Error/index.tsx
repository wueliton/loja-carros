import { FC } from 'react';
import styles from './Error.module.scss';

export const ErrorLabel: FC<{ error?: string }> = ({ error }) => {
  return <span className={styles.error}>{error}</span>;
};
