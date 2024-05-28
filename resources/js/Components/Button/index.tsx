import { ButtonHTMLAttributes, FC, PropsWithChildren } from "react";
import styles from './Button.module.scss';

export interface ButtonProps extends PropsWithChildren, ButtonHTMLAttributes<HTMLButtonElement> {
    active?: boolean;
    color?: 'primary' | 'accent' | 'warn';
    form?: string;
    contentEditable?: boolean
}

export const Button: FC<ButtonProps> = ({ children, className, active, color, ...props }) => {
    return <button {...props} className={`${styles.button} ${className} ${active ? styles.active : ''} ${color ? styles[color] : ''}`}>{children}</button>
}
