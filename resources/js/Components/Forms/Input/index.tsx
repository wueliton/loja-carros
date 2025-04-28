import { IconButton } from '@/Components/IconButton';
import { EyeIcon } from '@/Components/Icons/Eye';
import { EyeNoIcon } from '@/Components/Icons/EyeNo';
import { Mask } from '@/utils/mask/mask';
import { MaskOptions } from '@/utils/mask/types';
import {
  ChangeEvent,
  InputHTMLAttributes,
  ReactElement,
  forwardRef,
  useId,
  useState,
} from 'react';
import { ErrorLabel } from '../Error';
import styles from './Input.module.scss';

export interface InputProps
  extends Omit<InputHTMLAttributes<HTMLInputElement>, 'prefix' | 'value'> {
  label: string;
  error?: string;
  hint?: string;
  prefix?: ReactElement;
  suffix?: ReactElement;
  hideInput?: boolean;
  disabled?: boolean;
  mask?: MaskOptions;
  value?: string | number;
  unmaskedValueChange?: (value: string | number) => void;
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
      unmaskedValueChange,
      onChange,
      max,
      ...props
    },
    ref,
  ) => {
    const initialValue = mask ? Mask[mask](value ?? '', '', max) : value;
    const id = useId();
    const [showPass, setShowPass] = useState(false);
    const [valueState, setValueState] = useState(initialValue ?? '');

    const handleOnChage = (e: ChangeEvent<HTMLInputElement>) => {
      let value = e.target.value;
      if (mask) {
        value = Mask[mask](value, valueState, max) as string;
        if (mask === 'currency') {
          unmaskedValueChange?.(
            value.replace(/[^\d,-]/g, '').replace(',', '.'),
          );
        } else {
          unmaskedValueChange?.(Mask.number(value));
          e.target.value = String(Mask.number(value));
        }
      }

      setValueState(value);
      onChange?.(e);
    };

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
          <input
            {...props}
            id={id}
            value={valueState}
            type={showPass ? 'text' : type}
            disabled={disabled}
            hidden={hideInput}
            onChange={handleOnChage}
          />
          {type === 'password' ? (
            <IconButton
              icon={showPass ? <EyeNoIcon /> : <EyeIcon />}
              onClick={() => setShowPass((prev) => !prev)}
            />
          ) : (
            suffix && <>{suffix}</>
          )}
        </div>
        <p>{error ? <ErrorLabel error={error} /> : hint ?? ''}</p>
      </div>
    );
  },
);
