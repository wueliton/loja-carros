import { ButtonHTMLAttributes, FC, PropsWithChildren } from 'react';
import styles from './Button.module.scss';

export interface ButtonProps
  extends PropsWithChildren,
    ButtonHTMLAttributes<HTMLButtonElement> {
  active?: boolean;
  color?: 'primary' | 'accent' | 'warn';
  form?: string;
  variant?: 'basic' | 'outline';
  contentEditable?: boolean;
}

export const Button: FC<ButtonProps> = ({
  children,
  className,
  active,
  color,
  variant,
  ...props
}) => {
  return (
    <button
      {...props}
      className={`${styles.button} ${className} ${active ? styles.active : ''} ${color ? styles[color] : ''} ${styles[variant ?? 'outline']}`}
    >
      {children}
    </button>
  );
};
