import { IconButton } from '@/Components/IconButton';
import { CloseIcon } from '@/Components/Icons/Close';
import { TrashIcon } from '@/Components/Icons/Trash';
import { UploadIcon } from '@/Components/Icons/Upload';
import axios from 'axios';
import { uniqueId } from 'lodash';
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
import { v4 as uuidv4 } from 'uuid';
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
  url: string;
  onChange?: (files?: InitialFile[]) => void;
  onDelete?: (file: InitialFile) => void;
}

interface FileStateProps {
  id: string;
  file: File;
  isLoading: boolean;
  progress: number;
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
  url,
  onDelete,
  onChange,
  ...props
}: UploadFileProps<InitialFile>) => {
  const [uploadList, setUploadList] = useState<FileStateProps[]>();
  const [files, setFiles] = useState<InitialFile[]>();
  const [currentFiles, setCurrentFiles] = useState<InitialFile[]>();
  const [hoverActive, setHoverActive] = useState(false);
  const id = useId();
  const inputRef = useRef<HTMLInputElement>(null);

  const handleFilesChanges = useCallback((files?: InitialFile[] | null) => {
    const newFiles = Array.from(files ?? []);
    setFiles((prev) => [...newFiles, ...(prev ?? [])].slice(0, maxFiles));
    if (inputRef.current) inputRef.current.value = '';
  }, []);

  const handleChange = (e: ChangeEvent<HTMLInputElement>) => {
    const files = e.target.files;

    if (!files || !files.length) return;

    addFileToUploadList(Array.from(files));
  };

  const handleRemoveFile = (index: number) => {
    setFiles((prev) =>
      (prev ?? []).filter((_, fileIndex) => fileIndex !== index),
    );
  };

  const addFileToUploadList = (files: File[]) => {
    let filesState: FileStateProps[] = [];

    files.forEach((file) => {
      const fileId = uuidv4();
      filesState = [
        ...filesState,
        {
          id: fileId,
          file: file,
          isLoading: true,
          progress: 0,
        },
      ];

      handleUploadImage(file, fileId);
    });

    setUploadList((prev) => [...(prev ?? []), ...filesState]);
  };

  const handleUploadImage = async (file: File, id: string) => {
    const formData = new FormData();
    formData.append('image', file);

    const data = await axios.post<{ name: string }>(route(url), formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
      onUploadProgress: (progressEvent) => {
        if (progressEvent.total) {
          const percent = Math.round(
            (progressEvent.loaded * 100) / progressEvent.total,
          );
          setUploadList((prev) =>
            prev?.map((fileState) =>
              fileState.id === id
                ? {
                    ...fileState,
                    progress: percent,
                  }
                : fileState,
            ),
          );
        }
      },
    });

    setUploadList((prev) => prev?.filter((fileState) => fileState.id !== id));
    handleFilesChanges([{ fileName: data.data.name } as InitialFile]);
  };

  const handleDropFiles = (e: DragEvent<HTMLDivElement>) => {
    e.preventDefault();
    addFileToUploadList(Array.from(e.dataTransfer.files));
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

  useEffect(() => {
    setCurrentFiles(initialFiles);
  }, [initialFiles]);

  useEffect(() => {
    onChange?.(files);
  }, [files]);

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

      {(!!files?.length || !!currentFiles?.length || !!uploadList?.length) && (
        <div className={styles['list']}>
          <p>
            Arquivo{isMultiple ? 's' : ''} (
            {(files?.length ?? 0) + (currentFiles?.length ?? 0)}/{maxFiles})
          </p>
          {currentFiles?.map((file) => (
            <div
              className={`${styles['list-item']} ${styles['list-existing-file']}`}
              key={uniqueId()}
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
          {uploadList?.map(({ file, isLoading, progress }) => (
            <div className={styles['list-item']} key={uniqueId()}>
              <div className={styles['header']}>
                <span></span>
                <div className="flex-1">
                  <p>{file.name}</p>
                  <div className="w-full bg-gray-300 rounded-full h-2 mt-2">
                    {isLoading ? (
                      <div
                        className="bg-blue-600 h-2 rounded-full"
                        style={{ width: `${progress}%` }}
                      ></div>
                    ) : null}
                  </div>
                </div>
              </div>
            </div>
          ))}
          {files?.map((file, index) => (
            <div className={styles['list-item']} key={uniqueId()}>
              <div className={styles['header']}>
                <span>
                  <img src={`storage/uploads/${file.fileName}`} />
                </span>
                <div className="flex-1">
                  <p>{file.fileName}</p>
                  <p>Carregado</p>
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
