import { FC, HTMLAttributes } from 'react';
import styles from './Card.module.scss';

export const Card: FC<
  { children: React.ReactNode } & HTMLAttributes<HTMLDivElement>
> = ({ children, className, ...props }) => {
  return (
    <div className={`${styles.card} ${className ?? ''}`} {...props}>
      {children}
    </div>
  );
};
