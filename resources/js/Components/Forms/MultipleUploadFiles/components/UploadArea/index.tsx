import { ErrorLabel } from '@/Components/Forms/Error';
import { UploadIcon } from '@/Components/Icons/Upload';
import {
  ChangeEventHandler,
  DragEventHandler,
  useId,
  useRef,
  useState,
} from 'react';
import { UploadAreaStyles } from './styles';
import { UploadAreaProps } from './types';

function UploadArea({
  hint,
  isMultiple,
  accept,
  onChange,
  error,
  ...props
}: UploadAreaProps) {
  const [isDroppingState, setIsDroppingState] = useState(false);
  const inputRef = useRef<HTMLInputElement>(null);
  const id = useId();
  const hasError = Boolean(error);
  const { container, label, hint: hintStyles, input } = UploadAreaStyles();

  const handleFilesChange = (files?: FileList | null) => {
    if (files?.length) {
      onChange?.(Array.from(files));
    }
    if (inputRef.current) {
      inputRef.current.value = '';
    }
  };

  const handleChange: ChangeEventHandler<HTMLInputElement> = (event) => {
    const files = event.target.files;
    handleFilesChange(files);
  };

  const handleDropFiles: DragEventHandler<HTMLDivElement> = (event) => {
    event.preventDefault();
    event.stopPropagation();
    const files = event.dataTransfer.files;
    handleFilesChange(files);
  };

  const handleDragOver: DragEventHandler<HTMLDivElement> = (event) => {
    event.preventDefault();
    setIsDroppingState(true);
  };

  const handleDragLeave: DragEventHandler<HTMLDivElement> = (event) => {
    event.preventDefault();
    setIsDroppingState(false);
  };

  return (
    <div
      className={container()}
      onDrop={handleDropFiles}
      onDragOver={handleDragOver}
      onDragLeave={handleDragLeave}
    >
      <label className={label({ dragActive: isDroppingState })} htmlFor={id}>
        <UploadIcon />
        <p>
          <strong>Clique para adicionar arquivos</strong> ou arraste arquivos
          aqui.
        </p>
        {hint && <p className={hintStyles()}>{hint}</p>}
        <input
          {...props}
          ref={inputRef}
          id={id}
          type="file"
          multiple={isMultiple}
          accept={accept}
          onChange={handleChange}
          className={input()}
        />
      </label>
      {hasError ? <ErrorLabel error={error} /> : null}
    </div>
  );
}

export default UploadArea;
