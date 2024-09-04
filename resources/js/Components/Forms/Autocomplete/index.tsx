import { SpinIcon } from '@/Components/Icons/Spin';
import { Filter, Where } from '@/models/Filter';
import axios from 'axios';
import debounce from 'lodash/debounce';
import { ChangeEvent, useEffect, useRef, useState } from 'react';
import { AcceptedKeys, FloatingMenu } from '../../FloatingMenu';
import { Chip } from '../Chip';
import { Input } from '../Input';
import styles from './Autocomplete.module.scss';

export interface AutocompleteProps<
  T,
  isMulti extends boolean,
  CanCreate extends boolean,
> {
  label: string;
  propertyValue: keyof T;
  propertyToDisplay: keyof T;
  searchProperties: string[];
  moreThanOne?: isMulti;
  url: string;
  name?: string;
  value?: isMulti extends true ? T[keyof T][] : T[keyof T];
  error?: string;
  disabled?: boolean;
  autoFocus?: boolean;
  filter?: Where<T>[];
  className?: string;
  canCreate?: CanCreate;
  required?: boolean;
  onChange?: (values: isMulti extends true ? T[keyof T][] : T[keyof T]) => void;
  onChangeFull?: (values: isMulti extends true ? T[] : T) => void;
}

export const Autocomplete = <
  T,
  isMulti extends boolean = boolean,
  CanCreate extends boolean = false,
>({
  label,
  propertyToDisplay,
  propertyValue,
  searchProperties = [],
  moreThanOne,
  autoFocus,
  canCreate,
  className,
  disabled,
  required,
  filter,
  url,
  value,
  name,
  error,
  onChange,
  onChangeFull,
}: CanCreate extends true
  ? { createUrl: string } & AutocompleteProps<T, isMulti, CanCreate>
  : AutocompleteProps<T, isMulti, CanCreate>) => {
  const [loading, setLoading] = useState(true);
  const [search, setSearch] = useState<string | null>(null);
  const [selected, setSelected] = useState<T[]>([]);
  const [focused, setFocused] = useState<number>(0);
  const [opened, setOpened] = useState(false);
  const [options, setOptions] = useState<T[]>([]);
  const inputRef = useRef<HTMLDivElement | null>(null);
  const keyboardSelectRef = useRef<{ options: T[]; focused: number }>({
    options,
    focused,
  });

  const fetchResult = async (params: Filter<T>) => {
    const { data } = await axios.get<T[]>(url, {
      params,
    });

    return data;
  };

  const loadResults = async (inputSearch: string) => {
    const data = await fetchResult({
      where: {
        and: [
          {
            fieldName: propertyValue,
            comparison: 'ninq',
            value: selected.map((item) => item[propertyValue]),
          } as Where<T>,
          ...(searchProperties.map((prop) => ({
            fieldName: prop,
            comparison: 'contains',
            value: inputSearch,
          })) as unknown as Where<T>[]),
          ...(filter?.filter(
            (cond) => cond.comparison && cond.fieldName && cond.value,
          ) ?? []),
        ],
      },
    });
    setLoading(false);
    setOptions(data);
  };

  const loadInitialValues = async (value?: T[keyof T][]) => {
    if (!value || !value.length) {
      setSelected([]);
      return;
    }

    const data = await fetchResult({
      where: {
        and: [
          {
            fieldName: propertyValue,
            comparison: 'inq',
            value: value,
          } as Where<T>,
        ],
      },
      global: true,
    });

    setSelected(data);
  };

  const handleOpendMenu = () => {
    setOpened(true);
    setFocused(0);
    loadResults(search ?? '');
  };

  const handleSelectOption = (item: T) => {
    setSelected((prev) => Array.from(new Set([...prev, item])));
    setOpened(false);
  };

  const handleRemoveOption = (item: T) => {
    setSelected((prev) => prev.filter((selected) => selected !== item));
  };

  const handleTabPressed = (e: React.KeyboardEvent<HTMLInputElement>) => {
    if (e.key.toLowerCase() !== 'tab') return;
    setOpened(false);
  };

  const handlePressKey = (key: AcceptedKeys) => {
    const { options, focused } = keyboardSelectRef.current;
    switch (key) {
      case 'arrowup':
        setFocused((prev) => Math.max(0, prev - 1));
        break;
      case 'arrowdown':
        setFocused((prev) => Math.min(options.length - 1, prev + 1));
        break;
      default:
        handleSelectOption(options[focused]);
        setOpened(false);
        break;
    }
  };

  const debounceSearch = debounce((e: ChangeEvent<HTMLInputElement>) => {
    setLoading(true);
    setSearch(e.target.value);
    loadResults(e.target.value);
  }, 500);

  useEffect(() => {
    if (!value) {
      setSelected([]);
      return;
    }
    const valueToArray = Array.isArray(value) ? value : value ? [value] : [];
    if (
      valueToArray?.every((option) =>
        selected.some((item) => option === item[propertyValue]),
      )
    )
      return;
    loadInitialValues(valueToArray as T[keyof T][]);
  }, [value]);

  useEffect(() => {
    const allSelected = moreThanOne
      ? [...selected]
      : [...selected].splice(0, 1);
    const mappedChangedValues = allSelected.map((item) => item[propertyValue]);

    onChange?.(
      (moreThanOne
        ? mappedChangedValues
        : mappedChangedValues[0]) as isMulti extends true
        ? T[keyof T][]
        : T[keyof T],
    );
    onChangeFull?.(
      (moreThanOne ? selected : selected[0]) as isMulti extends true ? T[] : T,
    );
  }, [selected]);

  useEffect(() => {
    keyboardSelectRef.current = { options, focused };
  }, [options, focused]);

  useEffect(() => {
    setLoading(true);
    loadResults('');
  }, []);

  return (
    <div className={`${styles.field} ${className ?? ''}`}>
      <Input
        label={label}
        onChange={debounceSearch}
        onFocus={handleOpendMenu}
        onClick={handleOpendMenu}
        onKeyDown={handleTabPressed}
        disabled={disabled}
        hideInput={!moreThanOne && !!selected.length}
        prefix={
          !moreThanOne && selected.length ? (
            <div className={styles.prefix}>
              <Chip
                key="chip-selected"
                canRemove={!disabled}
                onRemove={() => handleRemoveOption(selected[0])}
              >
                <>{selected[0][propertyToDisplay]}</>
              </Chip>
            </div>
          ) : undefined
        }
        autoComplete="off"
        name={name}
        ref={inputRef}
        role="combobox"
        type="text"
        aria-autocomplete="list"
        aria-haspopup="listbox"
        error={error}
        autoFocus={autoFocus}
        required={required}
      ></Input>

      {moreThanOne && (
        <div className={styles.values}>
          {selected.map((item, index) => (
            <Chip
              key={`chip-${index}`}
              canRemove={!disabled}
              onRemove={() => handleRemoveOption(item)}
            >
              <>{item[propertyToDisplay]}</>
            </Chip>
          ))}
        </div>
      )}
      <FloatingMenu
        opened={opened}
        parent={inputRef}
        onClose={() => setOpened(false)}
        onKeyPressed={handlePressKey}
      >
        {loading ? (
          <div className={styles.loading}>
            <SpinIcon />
          </div>
        ) : (
          <>
            {!options.length && !canCreate && (
              <div className={styles.empty}>Nenhuma opção disponível</div>
            )}
            {!options.length && canCreate && search && (
              <div
                key={0}
                className={`${styles.option} ${focused === 0 ? styles['active-option'] : ''}`}
                onMouseEnter={() => setFocused(0)}
              >
                Criar "{search}"
              </div>
            )}
            {options.map((item, index) => (
              <div
                key={index}
                className={`${styles.option} ${focused === index ? styles['active-option'] : ''}`}
                onClick={() => handleSelectOption(item)}
                onMouseEnter={() => setFocused(index)}
              >
                <>{item[propertyToDisplay]}</>
              </div>
            ))}
          </>
        )}
      </FloatingMenu>
    </div>
  );
};
