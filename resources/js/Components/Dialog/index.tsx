import { FC, PropsWithChildren } from 'react';
import { IconButton } from '../IconButton';
import { CloseIcon } from '../Icons/Close';
import styles from './Dialog.module.scss';

interface DialogProps extends PropsWithChildren {
  open?: boolean;
  closeClicked: () => void;
}

export const Dialog: FC<DialogProps> = ({ children, open, closeClicked }) => {
  return (
    <div className={`${styles.backdrop} ${open ? styles.opened : ''}`}>
      <div className={styles.container}>
        <div className={styles.dialog}>
          <IconButton
            className={styles.close}
            icon={<CloseIcon />}
            onClick={closeClicked}
          >
            <span className="sr-only">Close modal</span>
          </IconButton>
          <div className={styles.content}>{children}</div>
        </div>
      </div>
    </div>
  );
};
