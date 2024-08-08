import { Paginated } from '@/models/Paginated';
import { ReactNode } from 'react';
import { Button } from '../Button';
import { EmptyIcon } from '../Icons/Empty';
import { PencilIcon } from '../Icons/Pencil';
import { TrashIcon } from '../Icons/Trash';
import { Paginate } from '../Paginate';
import styles from './Table.module.scss';

export interface TableProps<T> {
  data: Paginated<T>;
  onEdit?: (item: T) => unknown;
  headers: THeadProps<T>[];
  onDelete?: (item: T) => void;
  canDelete?: (item: T) => boolean;
  canEdit?: (item: T) => boolean;
}

export interface THeadProps<T> {
  key: keyof T;
  title: string;
  render?: (data: T) => ReactNode;
}

export const Table = <T,>({
  data,
  headers,
  onDelete,
  onEdit,
  canEdit,
  canDelete,
}: TableProps<T>) => {
  const handleDelete = (
    e: React.MouseEvent<HTMLButtonElement, MouseEvent>,
    item: T,
  ) => {
    e.preventDefault();
    e.stopPropagation();
    onDelete?.(item);
  };

  const handleEdit = (
    e: React.MouseEvent<HTMLElement, MouseEvent>,
    item: T,
  ) => {
    e.preventDefault();
    onEdit?.(item);
  };

  return (
    <div className={styles.container}>
      <table className={styles.table}>
        <thead>
          <tr>
            {headers.map((item) => (
              <th key={`table-head-${String(item.key)}`}>{item.title}</th>
            ))}
            {(onDelete || onEdit) && (
              <th className={styles['fixed-column']}></th>
            )}
          </tr>
        </thead>
        <tbody>
          {!data.data.length && (
            <tr className={styles['empty']}>
              <td colSpan={headers.length + (onDelete ? 1 : 0)}>
                <div className={styles['empty-list']}>
                  <EmptyIcon />
                  <h2>Nenhum item disponível</h2>
                  <p>Começe criando um novo item.</p>
                </div>
              </td>
            </tr>
          )}
          {data.data.map((item, index) => (
            <tr
              key={`table-line-${index}`}
              className={`${onEdit && (canEdit?.(item) ?? true) ? styles.canEdit : ''}`}
              onClick={(e) =>
                canEdit?.(item) ?? true ? handleEdit(e, item) : {}
              }
            >
              {headers.map(({ key, render }) => (
                <td key={`table-column-${String(key)}-${index}`}>
                  {render ? render(item) : <>{item[key]}</>}
                </td>
              ))}
              {(onDelete || onEdit) && (
                <td className={`${styles.actions} ${styles['fixed-column']}`}>
                  {onEdit && (canEdit?.(item) ?? true) && (
                    <Button icon={<PencilIcon />} />
                  )}
                  {onDelete && (canDelete?.(item) ?? true) && (
                    <Button
                      onClick={(e) => handleDelete(e, item)}
                      color="warn"
                      icon={<TrashIcon />}
                    />
                  )}
                </td>
              )}
            </tr>
          ))}
          <tr className={styles['empty']}>
            <td colSpan={headers.length + (onDelete ? 1 : 0)}>
              <Paginate {...data} />
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  );
};
