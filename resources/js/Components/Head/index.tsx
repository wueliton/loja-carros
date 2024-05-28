import { FC, PropsWithChildren } from "react";
import { Head as InertiaHead } from '@inertiajs/react';
import styles from './Head.module.scss';

export const Head: FC<PropsWithChildren<{ title: string }>> = ({ children, title }) => {
    return <header className={styles.header}>
        <InertiaHead title={title} />
        <h2 className={styles.title}>{title}</h2>
    </header>;
}
