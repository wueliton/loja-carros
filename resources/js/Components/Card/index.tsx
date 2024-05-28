import { FC } from "react";
import styles from './Card.module.scss';

export const Card: FC<{ children: React.ReactNode }> = ({ children }) => {
    return <div className={styles.card}>
        {children}
    </div>;
};
