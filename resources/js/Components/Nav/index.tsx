import { Link } from "@inertiajs/react";
import { FC } from "react";
import ApplicationLogo from "../ApplicationLogo";
import styles from "./Nav.module.scss";
import { DashboardIcon } from "../Icons/Dashboard";
import { UsersIcon } from "../Icons/Users";
import { NavLink } from "./NavLink";
import { StoreIcon } from "../Icons/Store";

export const NavComponent: FC = () => {
    return <nav className={`${styles.nav} ${styles.active}`}>
        <Link href="/" className={styles['logo-link']}>
            <ApplicationLogo className={styles.logo} />
        </Link>
        <div className={styles.links}>
            <NavLink href='dashboard'><DashboardIcon /> Dashboard</NavLink>
            <NavLink href='users.view'><UsersIcon /> Usuários</NavLink>
            <NavLink href='stores'><StoreIcon /> Lojas</NavLink>
        </div>
    </nav>;
}
