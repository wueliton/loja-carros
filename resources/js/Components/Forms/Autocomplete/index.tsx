import { SpinIcon } from '@/Components/Icons/Spin';
import { Filter, Where } from '@/models/Filter';
import axios from 'axios';
import debounce from 'lodash/debounce';
import { ChangeEvent, useEffect, useRef, useState } from 'react';
import { FloatingMenu } from '../../Menu';
import { Chip } from '../Chip';
import { Input } from '../Input';
import styles from './Autocomplete.module.scss';

export interface AutocompleteProps<T, isMulti extends boolean> {
  label: string;
  propertyValue: keyof T;
  propertyToDisplay: keyof T;
  searchProperties: string[];
  moreThanOne?: isMulti;
  url: string;
  name?: string;
  value?: isMulti extends true ? T[keyof T][] : T[keyof T];
  error?: string;
  autoFocus?: boolean;
  onChange?: (values: isMulti extends true ? T[keyof T][] : T[keyof T]) => void;
  onChangeFull?: (values: isMulti extends true ? T[] : T) => void;
}

export const Autocomplete = <T, isMulti extends boolean = boolean>({
  label,
  propertyToDisplay,
  propertyValue,
  searchProperties = [],
  moreThanOne,
  autoFocus,
  url,
  value,
  name,
  error,
  onChange,
  onChangeFull,
}: AutocompleteProps<T, isMulti>) => {
  const [loading, setLoading] = useState(true);
  const [search, setSearch] = useState<string | null>(null);
  const [selected, setSelected] = useState<T[]>([]);
  const [opened, setOpened] = useState(false);
  const [options, setOptions] = useState<T[]>([]);
  const inputRef = useRef<HTMLDivElement | null>(null);

  const fetchResult = async (params: Filter<T>) => {
    const { data } = await axios.get<T[]>(url, {
      params,
    });

    return data;
  };

  const loadResults = async (inputSearch: string) => {
    setSearch(inputSearch);
    const data = await fetchResult({
      where: [
        ...(searchProperties.map((prop) => ({
          fieldName: prop,
          comparison: 'contains',
          value: inputSearch,
        })) as unknown as Where<T>[]),
        {
          fieldName: propertyValue,
          comparison: 'ninq',
          value: selected.map((item) => item[propertyValue]),
        } as Where<T>,
      ],
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
      where: [
        {
          fieldName: propertyValue,
          comparison: 'inq',
          value: value,
        } as Where<T>,
      ],
    });

    setSelected(data);
  };

  const handleOpendMenu = () => {
    setOpened(true);
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

  const debounceSearch = debounce((e: ChangeEvent<HTMLInputElement>) => {
    setLoading(true);
    loadResults(e.target.value);
  }, 500);

  useEffect(() => {
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
    if (!selected.length) return;
    onChange?.(
      (moreThanOne
        ? selected.map((item) => item[propertyValue])
        : selected?.[0][propertyValue]) as isMulti extends true
        ? T[keyof T][]
        : T[keyof T],
    );
    onChangeFull?.(
      (moreThanOne ? selected : selected[0]) as isMulti extends true ? T[] : T,
    );
  }, [selected]);

  useEffect(() => {
    setLoading(true);
    loadResults('');
  }, []);

  return (
    <div className={styles.field}>
      <Input
        label={label}
        onChange={debounceSearch}
        onFocus={handleOpendMenu}
        onKeyDown={handleTabPressed}
        disabled={!moreThanOne && !!selected.length}
        prefix={
          !moreThanOne && selected.length ? (
            <Chip
              key="chip-selected"
              canRemove
              onRemove={() => handleRemoveOption(selected[0])}
            >
              <>{selected[0][propertyToDisplay]}</>
            </Chip>
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
      ></Input>

      {moreThanOne && (
        <div className={styles.values}>
          {selected.map((item, index) => (
            <Chip
              key={`chip-${index}`}
              canRemove
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
      >
        {loading ? (
          <div className={styles.loading}>
            <SpinIcon />
          </div>
        ) : (
          <>
            {!options.length && (
              <div className={styles.empty}>Nenhuma opção disponível</div>
            )}
            {options.map((item, index) => (
              <div
                key={index}
                className={styles.option}
                onClick={() => handleSelectOption(item)}
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
