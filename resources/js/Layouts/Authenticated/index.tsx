import { FC, PropsWithChildren } from "react";
import styles from './Authenticated.module.scss';
import { NavComponent } from "@/Components/Nav";

export const AuthenticatedLayout: FC<PropsWithChildren> = ({ children }) => {
    return <div className={styles.layout}>
        <NavComponent />
        <main>{children}</main>
    </div>
}
