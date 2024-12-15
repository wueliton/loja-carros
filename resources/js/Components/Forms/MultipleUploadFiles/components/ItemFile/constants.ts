import { UploadFileStatus } from '../../hooks/useUploadFiles/constants';
import { StatusToVariantProps } from './types';

const statusToVariant: StatusToVariantProps = {
  [UploadFileStatus.CANCELED]: 'canceled',
  [UploadFileStatus.COMPLETED]: 'completed',
  [UploadFileStatus.FAILED]: 'failed',
  [UploadFileStatus.PENDING]: 'pending',
  [UploadFileStatus.INVALID]: 'failed',
};

export { statusToVariant };
