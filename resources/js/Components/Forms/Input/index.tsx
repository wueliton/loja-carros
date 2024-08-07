import { IconButton } from '@/Components/IconButton';
import { EyeIcon } from '@/Components/Icons/Eye';
import { EyeNoIcon } from '@/Components/Icons/EyeNo';
import { useMask } from '@/Hooks/useMask';
import {
  InputHTMLAttributes,
  LegacyRef,
  ReactElement,
  forwardRef,
  useEffect,
  useId,
  useState,
} from 'react';
import { ReactMaskOpts } from 'react-imask';
import { ErrorLabel } from '../Error';
import styles from './Input.module.scss';

export interface InputProps
  extends Omit<InputHTMLAttributes<HTMLInputElement>, 'prefix'> {
  label: string;
  error?: string;
  hint?: string;
  prefix?: ReactElement;
  suffix?: ReactElement;
  hideInput?: boolean;
  disabled?: boolean;
  mask?:
    | string
    | (ReactMaskOpts['mask'] &
        { comparison?: (value: string) => boolean; mask: string }[])
    | unknown;
  maskOptions?: { [k in string]: unknown };
  unmaskedValueChange?: (value: string) => void;
}

export const Input = forwardRef<HTMLDivElement, InputProps>(
  (
    {
      label,
      error,
      prefix,
      suffix,
      hint,
      value,
      mask,
      type,
      required,
      hideInput,
      disabled,
      className,
      maskOptions,
      unmaskedValueChange,
      ...props
    },
    ref,
  ) => {
    const id = useId();
    const [showPass, setShowPass] = useState(false);
    const {
      ref: inputRef,
      setValue,
      unmaskedValue,
      value: maskValue,
    } = useMask({
      mask: mask,
      maskOptions,
    });

    useEffect(() => {
      setValue(String(value ?? ''));
    }, []);

    useEffect(() => {
      unmaskedValueChange?.(unmaskedValue);
    }, [unmaskedValue]);

    return (
      <div className={`${styles['form-field']} ${className ?? ''}`} ref={ref}>
        <label htmlFor={id}>
          {label}
          {required ? (
            <span className={styles.required}>
              * <span>(obrigatório)</span>
            </span>
          ) : (
            ''
          )}
        </label>
        <div className={styles['field']}>
          {prefix && <>{prefix}</>}
          {!hideInput && (
            <input
              {...props}
              id={id}
              ref={inputRef as LegacyRef<HTMLInputElement>}
              value={maskValue}
              type={showPass ? 'text' : type}
              disabled={disabled}
            />
          )}
          {type === 'password' ? (
            <IconButton
              icon={showPass ? <EyeNoIcon /> : <EyeIcon />}
              onClick={() => setShowPass((prev) => !prev)}
            />
          ) : (
            suffix && <>{suffix}</>
          )}
        </div>
        <p>
          {error ? <ErrorLabel error={error} fieldName={label} /> : hint ?? ''}
        </p>
      </div>
    );
  },
);
