import { Head as InertiaHead, Link } from '@inertiajs/react';
import { FC, Fragment, PropsWithChildren } from 'react';
import styles from './Head.module.scss';

export interface HeadProps extends PropsWithChildren {
  title: string;
  breadcrumb?: { title: string; url: string }[];
}

export const Head: FC<HeadProps> = ({ children, title, breadcrumb }) => {
  return (
    <header className={styles.header}>
      <InertiaHead title={title} />
      {breadcrumb?.length && (
        <div className={styles.breadcrumb}>
          {breadcrumb?.map((item, index) => (
            <Fragment key={`breadcrumb_link_${index}`}>
              <Link href={item.url}>{item.title}</Link>
              <span>{'>'}</span>
            </Fragment>
          ))}
        </div>
      )}

      <h2 className={styles.title}>{title}</h2>
      <div className={styles.actions}>{children}</div>
    </header>
  );
};