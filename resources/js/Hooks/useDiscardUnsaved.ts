import { DialogContentProps } from '@/Components/Dialog/Content';
import { useDialog } from '@/Context/Dialog';
import { router } from '@inertiajs/react';
import { useEffect, useRef } from 'react';

export interface DiscardUnsavedProps {
  content?: DialogContentProps;
  onConfirm?: () => void;
}

export const useDiscardUnsaved = (
  isDirty: boolean,
  props?: DiscardUnsavedProps,
) => {
  const { openDialog } = useDialog();
  const isDirtyRef = useRef<boolean>();
  const { content, onConfirm } = props ?? {};

  useEffect(() => {
    isDirtyRef.current = isDirty;
  }, [isDirty]);

  useEffect(() => {
    return router.on('before', (event) => {
      if (!isDirtyRef.current || event.detail.visit.method !== 'get')
        return true;
      openDialog({
        content: content ?? {
          title: 'Deseja sair?',
          content:
            'Há alterações não salvas no formulário, ao sair essas alterações serão perdidas.',
        },
        onClose: (confirm) => {
          if (!confirm) return;
          isDirtyRef.current = false;
          onConfirm?.();
          setTimeout(() => {
            router.visit(event.detail.visit.url, { preserveScroll: true });
          }, 10);
        },
      });
      return false;
    });
  }, []);
};
