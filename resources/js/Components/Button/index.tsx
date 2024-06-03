import {
  ButtonHTMLAttributes,
  FC,
  PropsWithChildren,
  ReactElement,
} from 'react';
import styles from './Button.module.scss';

export interface ButtonProps
  extends PropsWithChildren,
    ButtonHTMLAttributes<HTMLButtonElement> {
  active?: boolean;
  color?: 'primary' | 'accent' | 'warn';
  form?: string;
  variant?: 'basic' | 'outline';
  contentEditable?: boolean;
  icon?: ReactElement;
}

export const Button: FC<ButtonProps> = ({
  children,
  className,
  active,
  color,
  variant,
  icon,
  ...props
}) => {
  return (
    <button
      {...props}
      className={`${styles.button} ${className} ${active ? styles.active : ''} ${color ? styles[color] : ''} ${styles[variant ?? 'outline']} ${icon && !children ? styles['only-icon'] : ''}`}
    >
      {icon}
      {children}
    </button>
  );
};
