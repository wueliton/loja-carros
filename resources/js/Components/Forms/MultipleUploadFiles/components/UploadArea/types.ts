import { HTMLAttributes } from 'react';

interface UploadAreaProps
  extends Omit<HTMLAttributes<HTMLInputElement>, 'type' | 'onChange'> {
  hint?: string;
  isMultiple?: boolean;
  accept?: string;
  onChange?: (files: File[]) => void;
  error?: string;
}

export type { UploadAreaProps };
