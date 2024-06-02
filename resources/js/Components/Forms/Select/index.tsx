import { ArrowDownIcon } from '@/Components/Icons/ArrowDown';
import { FloatingMenu } from '@/Components/Menu';
import { useCallback, useEffect, useMemo, useRef, useState } from 'react';
import { ErrorLabel } from '../Error';
import styles from './Select.module.scss';

export interface SelectProps<T> {
  label: string;
  propertyValue: keyof T;
  propertyToDisplay: keyof T;
  hint?: string;
  value?: T[keyof T][];
  error?: string;
  moreThanOne?: boolean;
  options: T[];
  className?: string;
  onChange?: (values: T[keyof T][]) => void;
  onChangeFull?: (values: T[] | T) => void;
}

export const Select = <T,>({
  label,
  value: selectValue,
  error,
  hint,
  moreThanOne,
  className,
  options: selectOptions,
  propertyToDisplay,
  propertyValue,
  onChange,
  onChangeFull,
}: SelectProps<T>) => {
  const [selected, setSelected] = useState<T[]>([]);
  const [opened, setOpened] = useState(false);
  const inputRef = useRef<HTMLDivElement | null>(null);
  const selectedCountText = useMemo(() => {
    const length = selected.length;
    if (length <= 1) return;
    const selectedCount = length - 1;
    return `+${selectedCount} ${selectedCount > 1 ? 'Opções' : 'Opção'}`;
  }, [selected]);
  const isSelected = useCallback(
    (value: T) => {
      return selected.some(
        (option) => option[propertyValue] === value[propertyValue],
      );
    },
    [selected],
  );

  const options = useMemo(() => selectOptions, [selectOptions]);
  const value = useMemo(() => selectValue, [selectValue]);

  const handleSelectOption = useCallback(
    (item: T) => {
      if (isSelected(item)) {
        setSelected((prev) =>
          prev.filter(
            (option) => option[propertyValue] !== item[propertyValue],
          ),
        );
      } else {
        setSelected((prev) => (moreThanOne ? [...prev, item] : [item]));
      }
      setOpened(false);
    },
    [selected],
  );

  const handleTabPressed = useCallback(
    (e: React.KeyboardEvent<HTMLInputElement>) => {
      if (e.key.toLowerCase() !== 'tab') return;
      setOpened(false);
    },
    [],
  );

  useEffect(() => {
    const mappedValue = selected.reduce(
      (prev, item) =>
        item?.[propertyValue] !== undefined
          ? [...prev, item[propertyValue]]
          : prev,
      [] as T[keyof T][],
    );
    onChange?.(
      moreThanOne ? mappedValue : mappedValue[0] ? [mappedValue[0]] : [],
    );
    onChangeFull?.(moreThanOne ? selected : selected[0] ? [selected[0]] : []);
  }, [selected]);

  useEffect(() => {
    const selectedOptions = selected.map((sel) => sel[propertyValue]);

    if (value?.every((val) => selectedOptions.includes(val))) return;

    setSelected(
      options.filter((option) =>
        value?.some((val) => option[propertyValue] === val),
      ),
    );
  }, [value]);

  return (
    <div
      tabIndex={0}
      className={`${styles['form-field']} ${className ?? ''}`}
      onFocus={() => setOpened(true)}
      onClick={() => setOpened(true)}
      onKeyDown={handleTabPressed}
    >
      <div ref={inputRef} className={styles.container}>
        <span className={styles.label}>{label}</span>
        <div className={styles.field}>
          <span className={styles['field-label']}>
            <>{!!selected.length && selected[0][propertyToDisplay]}</>
            {moreThanOne && selectedCountText && (
              <span>({selectedCountText})</span>
            )}
          </span>
          <ArrowDownIcon />
        </div>
        <p>{error ? <ErrorLabel error={error} /> : hint ?? ''}</p>
      </div>
      <FloatingMenu
        opened={opened}
        parent={inputRef}
        onClose={() => setOpened(false)}
      >
        {options.map((option) => (
          <div
            key={`select-option-${option[propertyValue]}`}
            onClick={() => handleSelectOption(option)}
            className={styles.option}
          >
            <input type="checkbox" checked={isSelected(option)} readOnly />
            <>{option[propertyToDisplay]}</>
          </div>
        ))}
      </FloatingMenu>
    </div>
  );
};
