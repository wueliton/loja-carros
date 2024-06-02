import { DialogContentProps } from '@/Components/Dialog/Content';
import { useDialog } from '@/Context/Dialog';
import { router } from '@inertiajs/react';
import { useEffect } from 'react';

export interface DiscardUnsavedProps {
  isDirty?: boolean;
  content?: DialogContentProps;
  onConfirm?: () => void;
}

export const useDiscardUnsaved = ({
  isDirty,
  content,
  onConfirm,
}: DiscardUnsavedProps) => {
  const { openDialog } = useDialog();

  useEffect(() => {
    return router.on('before', (event) => {
      if (!isDirty || event.detail.visit.method !== 'get') return true;
      openDialog({
        content: content ?? {
          title: 'Deseja sair?',
          content:
            'Há alterações não salvas no formulário, ao sair essas alterações serão perdidas.',
        },
        onClose: (confirm) => {
          if (!confirm) return;
          onConfirm?.();
          setTimeout(() => {
            router.visit(event.detail.visit.url);
          }, 10);
        },
      });
      return false;
    });
  }, [isDirty]);
};
