import { Head as InertiaHead, Link } from '@inertiajs/react';
import { FC, Fragment, PropsWithChildren } from 'react';
import { ArrowRightIcon } from '../Icons/ArrowRight';
import { Folder } from '../Icons/Folder';
import styles from './Head.module.scss';

export interface HeadProps extends PropsWithChildren {
  title: string;
  breadcrumb?: { title: string; url: string }[];
  hideTitle?: boolean;
}

export const Head: FC<HeadProps> = ({
  children,
  title,
  breadcrumb,
  hideTitle,
}) => {
  return (
    <header className={styles.header}>
      <InertiaHead title={title} />
      {breadcrumb?.length && (
        <div className={styles.breadcrumb}>
          {breadcrumb?.map((item, index) => (
            <Fragment key={`breadcrumb_link_${index}`}>
              <Link href={item.url} preserveScroll className={styles.folder}>
                <Folder />
                {item.title}
              </Link>
              <ArrowRightIcon />
            </Fragment>
          ))}
        </div>
      )}

      {!hideTitle && <h2 className={styles.title}>{title}</h2>}
      <div className={styles.actions}>{children}</div>
    </header>
  );
};
