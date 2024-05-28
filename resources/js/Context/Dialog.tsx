import { Dialog } from '@/Components/Dialog';
import { DialogContent, DialogContentProps } from '@/Components/Dialog/Content';
import {
  FC,
  PropsWithChildren,
  ReactElement,
  createContext,
  createElement,
  useContext,
  useState,
} from 'react';

export interface OpenDialogProps {
  onClose?: (data?: unknown) => void;
}

export interface DialogComponentProps extends OpenDialogProps {
  component: FC<{ close: (data?: unknown) => void }>;
}

export interface DialogTextProps extends OpenDialogProps {
  content: DialogContentProps;
}

export interface DialogContextProps {
  openDialog: (props: DialogComponentProps | DialogTextProps) => void;
}

export const DialogContext = createContext<DialogContextProps>(
  {} as DialogContextProps,
);

let dialogOnClose: ((data?: unknown) => void) | null = null;

export const DialogProvider: FC<PropsWithChildren> = ({ children }) => {
  const [opened, setOpened] = useState(false);
  const [activeComponent, setActiveComponent] = useState<ReactElement | null>(
    null,
  );
  const [content, setContent] = useState<DialogContentProps | null>(null);

  const openDialog = ({
    onClose,
    ...props
  }: DialogComponentProps | DialogTextProps) => {
    if (onClose) dialogOnClose = onClose;
    if ((props as DialogComponentProps).component)
      setActiveComponent(
        createElement((props as DialogComponentProps).component, {
          close: handleClose,
        }),
      );
    else setContent((props as DialogTextProps).content!);
    setOpened(true);
  };

  const handleClose = (data?: unknown) => {
    dialogOnClose?.(data);
    setOpened(false);
    setActiveComponent(null);
    setContent(null);
  };

  return (
    <DialogContext.Provider value={{ openDialog }}>
      <Dialog open={opened} closeClicked={() => handleClose(false)}>
        <div>
          {activeComponent ? (
            activeComponent
          ) : (
            <DialogContent {...content!} close={handleClose} />
          )}
        </div>
      </Dialog>
      {children}
    </DialogContext.Provider>
  );
};

export const useDialog = () => {
  return useContext(DialogContext);
};
