import { IconButton } from '@/Components/IconButton';
import { CloseIcon } from '@/Components/Icons/Close';
import { UploadIcon } from '@/Components/Icons/Upload';
import {
  ChangeEvent,
  FC,
  HTMLAttributes,
  useCallback,
  useEffect,
  useId,
  useRef,
  useState,
} from 'react';
import styles from './UploadFile.module.scss';

export interface UploadFileProps
  extends Omit<HTMLAttributes<HTMLInputElement>, 'type' | 'onChange'> {
  isMultiple?: boolean;
  hint?: string;
  onChange?: (files?: File[]) => void;
}

export const UploadFile: FC<UploadFileProps> = ({
  className,
  hint,
  onChange,
  ...props
}) => {
  const [files, setFiles] = useState<File[]>();
  const id = useId();
  const inputRef = useRef<HTMLInputElement>(null);

  const handleChange = (e: ChangeEvent<HTMLInputElement>) => {
    setFiles(Array.from(e.target.files ?? []));
    if (inputRef.current) inputRef.current.value = '';
  };

  const handleRemoveFile = (index: number) => {
    setFiles((prev) => prev?.filter((_, fileIndex) => fileIndex !== index));
  };

  const calculateSize = useCallback(
    (fileSize: number) => (fileSize / (1024 * 1024)).toFixed(2) + 'MB',
    [],
  );

  useEffect(() => {
    if (!onChange) return;
    onChange(files);
  }, [files]);

  return (
    <div className={className}>
      <div className={styles['file-upload']}>
        <label htmlFor={id}>
          <UploadIcon />
          <p>
            <strong>Clique para adicionar arquivos</strong> ou arraste arquivos
            aqui.
          </p>
          {hint && <p className={styles.hint}>{hint}</p>}
          <input
            {...props}
            ref={inputRef}
            id={id}
            type="file"
            onChange={handleChange}
          />
        </label>
      </div>

      {!!files?.length && (
        <div className={styles['list']}>
          <p>Arquivos</p>
          {files.map((file, index) => (
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
    </div>
  );
};
