import { IconButton } from '@/Components/IconButton';
import { CloseIcon } from '@/Components/Icons/Close';
import { DragIndicator } from '@/Components/Icons/DragIndicator';
import { RetryIcon } from '@/Components/Icons/Retry';
import { TrashIcon } from '@/Components/Icons/Trash';
import { UploadFileStatus } from '../../hooks/useUploadFiles/constants';
import { statusToVariant } from './constants';
import { ItemFileStyles } from './styles';
import { ItemFileProps } from './types';

function ItemFile({
  status,
  name,
  file,
  progress,
  cancelToken,
  className,
  counter,
  canDelete,
  onRemoveFile,
  onRetry,
  onDeleteFile,
}: ItemFileProps) {
  const convertedStatus = statusToVariant[status];
  const {
    container,
    content,
    icon,
    title,
    subtitle,
    progressBar,
    titleContainer,
    progressIndicator,
    dragIndicator,
    counter: counterStyle,
  } = ItemFileStyles({
    status: convertedStatus,
  });
  const isLoadingStatus = status === UploadFileStatus.PENDING;
  const [fileName, extension] = (file?.name ?? name ?? '').split('.');

  const renderIcon = () => {
    if (file) {
      return <img src={URL.createObjectURL(file)} />;
    }

    return <img src={`storage/uploads/${name}`} />;
  };

  const renderActions = () => {
    if (status === UploadFileStatus.PENDING) {
      return (
        <IconButton
          size="xs"
          icon={<CloseIcon />}
          onClick={() => cancelToken?.cancel()}
        />
      );
    }

    if (status === UploadFileStatus.COMPLETED && canDelete) {
      return (
        <IconButton size="xs" icon={<TrashIcon />} onClick={onDeleteFile} />
      );
    }

    if (
      status == UploadFileStatus.INVALID ||
      status === UploadFileStatus.CANCELED
    ) {
      return (
        <IconButton size="xs" icon={<TrashIcon />} onClick={onRemoveFile} />
      );
    }

    if (status === UploadFileStatus.FAILED) {
      return <IconButton size="xs" icon={<RetryIcon />} onClick={onRetry} />;
    }

    return null;
  };

  return (
    <div className={container({ className: className })}>
      <div className={dragIndicator()}>
        <DragIndicator />
      </div>
      <div className={content()}>
        {counter ? <div className={counterStyle()}>{counter}</div> : null}
        <div className={icon()}>{renderIcon()}</div>
        <div className={titleContainer()}>
          <p className={title()}>{fileName}</p>
          <p className={subtitle()}>{extension}</p>
        </div>
        <div>{renderActions()}</div>
      </div>
      {isLoadingStatus ? (
        <div className={progressBar()}>
          <div
            className={progressIndicator()}
            style={{ width: `${progress ?? 0}%` }}
          ></div>
        </div>
      ) : null}
    </div>
  );
}

export default ItemFile;
