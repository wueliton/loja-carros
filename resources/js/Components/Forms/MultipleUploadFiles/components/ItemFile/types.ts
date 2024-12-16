import { VariantProps } from 'tailwind-variants';
import { UploadFileStatus } from '../../hooks/useUploadFiles/constants';
import { FileStateProps } from '../../hooks/useUploadFiles/types';
import { ItemFileStyles } from './styles';

type ItemFileProps = FileStateProps & {
  onRemoveFile: () => void;
  onDeleteFile: () => void;
  onRetry?: () => void;
  className?: string;
  counter?: number;
  canDelete?: boolean;
};

type ItemFileVariants = VariantProps<typeof ItemFileStyles>;

type StatusToVariantProps = {
  [k in UploadFileStatus]: ItemFileVariants['status'];
};

export type { ItemFileProps, StatusToVariantProps };
