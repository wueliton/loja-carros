import { CancelTokenSource } from 'axios';
import { UploadFileStatus } from './constants';

interface InitialFilesProps {
  id?: string;
  name?: string;
  order?: number;
}

interface UseUploadFilesProps {
  accept?: string;
  maxFiles?: number;
  maxSize?: number;
  url: string;
  initialFiles?: InitialFilesProps[];
  onDelete?: (file: InitialFilesProps) => void;
  onChange?: (files: InitialFilesProps[]) => void;
}

interface FileStateProps {
  file?: File;
  name?: string;
  id: string;
  isLoading: boolean;
  status: UploadFileStatus;
  progress?: number;
  cancelToken?: CancelTokenSource;
  initial?: boolean;
}

interface UploadFileProps {
  id: string;
  file?: File;
  cancelToken?: CancelTokenSource;
}

export type {
  FileStateProps,
  InitialFilesProps,
  UploadFileProps,
  UseUploadFilesProps,
};
