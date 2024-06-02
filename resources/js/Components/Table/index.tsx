import { ReactNode } from 'react';
import { Button } from '../Button';
import { EmptyIcon } from '../Icons/Empty';
import { TrashIcon } from '../Icons/Trash';
import styles from './Table.module.scss';

export interface TableProps<T> {
  data: T[];
  onEdit?: (item: T) => unknown;
  headers: THeadProps<T>[];
  onDelete?: (item: T) => void;
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
            {onDelete && <th></th>}
          </tr>
        </thead>
        <tbody>
          {!data.length && (
            <tr>
              <td colSpan={headers.length + (onDelete ? 1 : 0)}>
                <div className={styles['empty-list']}>
                  <EmptyIcon />
                  <h2>Nenhum item disponível</h2>
                  <p>Começe criando um novo item.</p>
                </div>
              </td>
            </tr>
          )}
          {data.map((item, index) => (
            <tr
              key={`table-line-${index}`}
              className={`${onEdit ? 'cursor-pointer' : ''}`}
              onClick={(e) => handleEdit(e, item)}
            >
              {headers.map(({ key, render }) => (
                <td key={`table-column-${String(key)}-${index}`}>
                  {render ? render(item) : <>{item[key]}</>}
                </td>
              ))}
              {onDelete && (
                <td>
                  <Button onClick={(e) => handleDelete(e, item)} color="warn">
                    <TrashIcon />
                  </Button>
                </td>
              )}
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};
