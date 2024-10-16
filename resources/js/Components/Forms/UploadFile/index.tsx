import { IconButton } from '@/Components/IconButton';
import { CloseIcon } from '@/Components/Icons/Close';
import { TrashIcon } from '@/Components/Icons/Trash';
import { UploadIcon } from '@/Components/Icons/Upload';
import {
  ChangeEvent,
  DragEvent,
  HTMLAttributes,
  ReactElement,
  useCallback,
  useEffect,
  useId,
  useRef,
  useState,
} from 'react';
import { ErrorLabel } from '../Error';
import styles from './UploadFile.module.scss';

export type SavedFile = { fileName?: string };

export interface UploadFileProps<InitialFile extends SavedFile>
  extends Omit<HTMLAttributes<HTMLInputElement>, 'type' | 'onChange'> {
  isMultiple?: boolean;
  hint?: string;
  error?: string;
  fieldName?: string;
  handle?: ReactElement;
  accept?: string;
  maxFiles?: number;
  files?: InitialFile[];
  onChange?: (files?: File[]) => void;
  onDelete?: (file: InitialFile) => void;
}

export const UploadFile = <InitialFile extends SavedFile>({
  className,
  hint,
  error,
  files: initialFiles,
  fieldName,
  isMultiple,
  maxFiles,
  handle,
  accept,
  onChange,
  onDelete,
  ...props
}: UploadFileProps<InitialFile>) => {
  const [files, setFiles] = useState<File[]>();
  const [currentFiles, setCurrentFiles] = useState<InitialFile[]>();
  const [hoverActive, setHoverActive] = useState(false);
  const id = useId();
  const inputRef = useRef<HTMLInputElement>(null);

  const handleFilesChanges = useCallback((files?: FileList | null) => {
    const newFiles = Array.from(files ?? []);
    setFiles((prev) => [...(prev ?? []), ...newFiles].slice(0, maxFiles));
    if (inputRef.current) inputRef.current.value = '';
  }, []);

  const handleChange = (e: ChangeEvent<HTMLInputElement>) =>
    handleFilesChanges(e.target.files);

  const handleRemoveFile = (index: number) => {
    setFiles((prev) => prev?.filter((_, fileIndex) => fileIndex !== index));
  };

  const handleDropFiles = (e: DragEvent<HTMLDivElement>) => {
    e.preventDefault();
    handleFilesChanges(e.dataTransfer.files);
    setHoverActive(false);
  };

  const handleDeleteFile = (file: InitialFile) => {
    onDelete?.(file);
  };

  const handleDragOver = (e: DragEvent<HTMLDivElement>) => {
    e.preventDefault();
    setHoverActive(true);
  };

  const handleDragLeave = () => {
    setHoverActive(false);
  };

  const calculateSize = useCallback(
    (fileSize: number) => (fileSize / (1024 * 1024)).toFixed(2) + 'MB',
    [],
  );

  useEffect(() => {
    if (!onChange) return;
    onChange(files);
  }, [files]);

  useEffect(() => {
    setCurrentFiles(initialFiles);
  }, [initialFiles]);

  return (
    <div className={className} aria-label={fieldName}>
      {(files?.length || 0) + (initialFiles?.length ?? 0) < (maxFiles || 1) && (
        <>
          {handle && (
            <label className="inline-block cursor-pointer" htmlFor={id}>
              {handle}
            </label>
          )}
          <div className={handle ? 'hidden' : ''}>
            <div
              className={`${styles['file-upload']} ${hoverActive ? styles.active : ''}`}
              onDrop={handleDropFiles}
              onDragOver={handleDragOver}
              onDragLeave={handleDragLeave}
            >
              <label htmlFor={id}>
                <UploadIcon />
                <p>
                  <strong>Clique para adicionar arquivos</strong> ou arraste
                  arquivos aqui.
                </p>
                {hint && <p className={styles.hint}>{hint}</p>}
                <input
                  {...props}
                  ref={inputRef}
                  id={id}
                  type="file"
                  multiple={isMultiple}
                  accept={accept}
                  onChange={handleChange}
                />
              </label>
            </div>
          </div>
        </>
      )}

      {(!!files?.length || !!currentFiles?.length) && (
        <div className={styles['list']}>
          <p>
            Arquivo{isMultiple ? 's' : ''} (
            {(files?.length ?? 0) + (currentFiles?.length ?? 0)}/{maxFiles})
          </p>
          {currentFiles?.map((file, index) => (
            <div
              className={`${styles['list-item']} ${styles['list-existing-file']}`}
              key={index}
            >
              <div className={styles['header']}>
                <span>
                  <img src={`storage/uploads/${file.fileName}`} />
                </span>
                <div>
                  <p>{file.fileName}</p>
                  <p>Arquivo salvo</p>
                </div>
                <IconButton
                  size="xs"
                  onClick={() => handleDeleteFile(file)}
                  icon={<TrashIcon />}
                />
              </div>
            </div>
          ))}
          {files?.map((file, index) => (
            <div className={styles['list-item']} key={index}>
              <div className={styles['header']}>
                <span></span>
                <div>
                  <p>{file.name}</p>
                  <p>{calculateSize(file.size)}</p>
                </div>
                <IconButton
                  size="xs"
                  onClick={() => handleRemoveFile(index)}
                  icon={<CloseIcon />}
                />
              </div>
            </div>
          ))}
        </div>
      )}
      <ErrorLabel error={error} />
    </div>
  );
};
