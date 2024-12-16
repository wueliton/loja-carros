enum UploadFileStatus {
  PENDING = 'PENDING',
  COMPLETED = 'COMPLETED',
  FAILED = 'FAILED',
  CANCELED = 'CANCELED',
  INVALID = 'INVALID',
}

const UploadFileConfig = {
  maxSizeMB: 1.5,
  maxWidthOrHeight: 1200,
};

export { UploadFileConfig, UploadFileStatus };
