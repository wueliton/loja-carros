import { Dialog as HDialog, Transition } from '@headlessui/react';
import { FC, Fragment, PropsWithChildren } from 'react';

interface DialogProps extends PropsWithChildren {
  open?: boolean;
  closeClicked: () => void;
}

export const Dialog: FC<DialogProps> = ({ children, open, closeClicked }) => {
  return (
    <Transition show={open} as={Fragment} leave="duration-200">
      <HDialog
        as="div"
        className="fixed inset-0 flex overflow-y-auto px-4 py-6 sm:px-0 items-center z-50 transform transition-all"
        onClose={() => closeClicked?.()}
      >
        <Transition.Child
          as={Fragment}
          enter="ease-out duration-300"
          enterFrom="opacity-0"
          enterTo="opacity-100"
          leave="ease-in duration-200"
          leaveFrom="opacity-100"
          leaveTo="opacity-0"
        >
          <div className="absolute inset-0 bg-black/30" />
        </Transition.Child>

        <Transition.Child
          as={Fragment}
          enter="ease-out duration-300"
          enterFrom="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enterTo="opacity-100 translate-y-0 sm:scale-100"
          leave="ease-in duration-200"
          leaveFrom="opacity-100 translate-y-0 sm:scale-100"
          leaveTo="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
          <HDialog.Panel
            className={
              'mb-6 bg-white rounded-lg shadow-xl transform transition-all sm:w-full mx-auto p-4 w-full max-w-md'
            }
          >
            <div>{children}</div>
          </HDialog.Panel>
        </Transition.Child>
      </HDialog>
    </Transition>
  );
};
