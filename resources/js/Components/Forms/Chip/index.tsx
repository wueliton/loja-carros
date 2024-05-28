import { IconButton } from '@/Components/IconButton';
import { CloseIcon } from '@/Components/Icons/Close';
import { FC, PropsWithChildren } from 'react';
import styles from './Chip.module.scss';

export interface ChipProps extends PropsWithChildren {
  checked?: boolean;
  canRemove?: boolean;
  onRemove?: () => void;
}

export const Chip: FC<ChipProps> = ({
  checked,
  canRemove,
  onRemove,
  children,
}) => {
  return (
    <div className={`${styles.chip} ${checked ? styles.checked : ''}`}>
      {children}
      {canRemove && (
        <IconButton
          icon={<CloseIcon />}
          onClick={() => onRemove?.()}
          size="xs"
        />
      )}
    </div>
  );
};
