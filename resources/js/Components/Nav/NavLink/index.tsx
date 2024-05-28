import { InertiaLinkProps, Link } from "@inertiajs/react";
import { FC, useCallback } from "react";
import styles from "./NavLink.module.scss";

export const NavLink: FC<InertiaLinkProps> = ({
    className = "",
    children,
    href,
    ...props
}) => {
    const active = useCallback(() => route().current(href), [href]);

    return (
        <Link
            href={route(href)}
            {...props}
            className={`${className} ${styles.link} ${
                active() ? styles.active : ""
            }`}
        >
            {children}
        </Link>
    );
};
