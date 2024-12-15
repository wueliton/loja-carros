import { ReactSortable } from 'react-sortablejs';
import ItemFile from './components/ItemFile';
import UploadArea from './components/UploadArea';
import { DISABLED_DRAG_ITEM } from './constants';
import useUploadFiles from './hooks/useUploadFiles';
import { UploadFileStatus } from './hooks/useUploadFiles/constants';
import { MultipleUploadFilesStyle } from './styles';
import { MultipleUploadFilesProps } from './types';

function MultipleUploadFiles({
  accept,
  maxFiles,
  maxSize,
  url,
  initialFiles,
  hint,
  error,
  className,
  onDelete,
  onChange,
}: MultipleUploadFilesProps) {
  const {
    canUpdateFiles,
    files,
    filesUploadCount,
    setFiles,
    addFile,
    removeFile,
    onRetry,
    deleteFile,
    canDelete,
  } = useUploadFiles({
    accept,
    maxFiles,
    maxSize,
    url,
    initialFiles,
    onDelete,
    onChange,
  });
  const { container, fileList, fileListTitle } = MultipleUploadFilesStyle();
  const isMultiple = Boolean(maxFiles && maxFiles > 1);

  return (
    <div className={container({ className })}>
      {canUpdateFiles ? (
        <UploadArea
          onChange={addFile}
          hint={hint}
          error={error}
          accept={accept}
          isMultiple={isMultiple}
        />
      ) : null}
      <div className={fileList()}>
        <p className={fileListTitle()}>Arquivos ({filesUploadCount})</p>
        <ReactSortable
          swap
          list={files}
          setList={setFiles}
          className={fileList()}
          filter={`.${DISABLED_DRAG_ITEM}`}
        >
          {files.map((file, index) => (
            <ItemFile
              {...file}
              key={file.id}
              counter={index + 1}
              onRemoveFile={() => removeFile(file.id)}
              onDeleteFile={() => deleteFile(file, index)}
              onRetry={() => onRetry(file)}
              canDelete={canDelete(file.id)}
              className={
                [
                  UploadFileStatus.CANCELED,
                  UploadFileStatus.FAILED,
                  UploadFileStatus.INVALID,
                ].includes(file.status)
                  ? 'disabled'
                  : ''
              }
            />
          ))}
        </ReactSortable>
      </div>
    </div>
  );
}

export default MultipleUploadFiles;
