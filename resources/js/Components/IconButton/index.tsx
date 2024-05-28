import {
  ButtonHTMLAttributes,
  FC,
  PropsWithChildren,
  ReactElement,
} from 'react';
import styles from './IconButton.module.scss';

export interface IconButtonProps
  extends PropsWithChildren,
    ButtonHTMLAttributes<HTMLButtonElement> {
  icon: ReactElement;
  size?: 'xs' | 'md' | 'lg' | 'xl';
}

export const IconButton: FC<IconButtonProps> = ({
  icon,
  className,
  size,
  children,
  ...props
}) => {
  return (
    <button
      {...props}
      type={props.type ?? 'button'}
      className={`${className ?? ''} ${styles['icon-button']} ${styles[size ?? 'md']}`}
    >
      {icon}
      {children}
    </button>
  );
};
