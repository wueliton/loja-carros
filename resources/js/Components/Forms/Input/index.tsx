import { InputMask, Modify, Replacement } from '@react-input/mask';
import { InputHTMLAttributes, ReactElement, forwardRef, useId } from 'react';
import { Error } from '../Error';
import styles from './Input.module.scss';

export interface InputProps
  extends Omit<InputHTMLAttributes<HTMLInputElement>, 'prefix'> {
  label: string;
  error?: string;
  hint?: string;
  prefix?: ReactElement;
  suffix?: ReactElement;
  mask?: string;
  replacement?: string | Replacement;
  showMask?: boolean;
  modify?: Modify;
}

export const Input = forwardRef<HTMLDivElement, InputProps>(
  (
    {
      label,
      error,
      prefix,
      suffix,
      hint,
      mask,
      replacement,
      showMask,
      modify,
      className,
      ...props
    },
    ref,
  ) => {
    const id = useId();

    return (
      <div
        className={`${styles['form-field']} ${error ? styles.error : ''} ${className ?? ''}`}
        ref={ref}
      >
        <label htmlFor={id}>{label}</label>
        <div className={styles['field']}>
          {prefix && <>{prefix}</>}
          {mask ? (
            <InputMask
              {...props}
              mask={mask}
              replacement={replacement}
              showMask={showMask}
              modify={modify}
              id={id}
              value={props.value}
              onChange={(e) => {
                props.onChange?.(e);
              }}
            />
          ) : (
            <input
              {...props}
              id={id}
              value={props.value}
              onChange={(e) => {
                props.onChange?.(e);
              }}
            />
          )}
          {suffix && <>{suffix}</>}
        </div>
        <p>{error ? <Error error={error} fieldName={label} /> : hint ?? ''}</p>
      </div>
    );
  },
);
