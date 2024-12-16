import { InitialFilesProps } from './hooks/useUploadFiles/types';

interface MultipleUploadFilesProps {
  accept?: string;
  maxFiles?: number;
  maxSize?: number;
  url: string;
  initialFiles?: InitialFilesProps[];
  hint?: string;
  className?: string;
  error?: string;
  onDelete?: (file: InitialFilesProps) => void;
  onChange?: (files: InitialFilesProps[]) => void;
}

export type { MultipleUploadFilesProps };
