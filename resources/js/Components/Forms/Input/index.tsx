import {
  InputHTMLAttributes,
  LegacyRef,
  ReactElement,
  forwardRef,
  useEffect,
  useId,
} from 'react';
import { ReactMaskOpts, useIMask } from 'react-imask';
import { Error } from '../Error';
import styles from './Input.module.scss';

export interface InputProps
  extends Omit<InputHTMLAttributes<HTMLInputElement>, 'prefix'> {
  label: string;
  error?: string;
  hint?: string;
  prefix?: ReactElement;
  suffix?: ReactElement;
  mask?:
    | string
    | (ReactMaskOpts['mask'] &
        { comparison?: (value: string) => boolean; mask: string }[]);
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
      className,
      unmaskedValueChange,
      ...props
    },
    ref,
  ) => {
    const id = useId();
    const {
      ref: inputRef,
      setValue,
      unmaskedValue,
      value: maskValue,
    } = useIMask({
      mask: (mask as string) ?? new RegExp(''),
      dispatch: (_, dynamicMasked) => {
        const value = dynamicMasked.value;
        return dynamicMasked.compiledMasks.find(
          (m) =>
            (
              m as unknown as { comparison: (value: string) => boolean }
            ).comparison?.(value) ?? true,
        );
      },
    });

    useEffect(() => {
      setValue(String(value ?? ''));
    }, []);

    useEffect(() => {
      unmaskedValueChange?.(unmaskedValue);
    }, [unmaskedValue]);

    return (
      <div className={`${styles['form-field']} ${className ?? ''}`} ref={ref}>
        <label htmlFor={id}>{label}</label>
        <div className={styles['field']}>
          {prefix && <>{prefix}</>}
          <input
            {...props}
            id={id}
            ref={inputRef as LegacyRef<HTMLInputElement>}
            value={maskValue}
          />
          {suffix && <>{suffix}</>}
        </div>
        <p>{error ? <Error error={error} fieldName={label} /> : hint ?? ''}</p>
      </div>
    );
  },
);
