import { SpinIcon } from '@/Components/Icons/Spin';
import { Filter, Where } from '@/models/Filter';
import axios from 'axios';
import debounce from 'lodash/debounce';
import { ChangeEvent, useEffect, useRef, useState } from 'react';
import { FloatingMenu } from '../../Menu';
import { Chip } from '../Chip';
import { Input } from '../Input';
import styles from './Autocomplete.module.scss';

export interface AutocompleteProps<T> {
  label: string;
  propertyValue: keyof T;
  propertyToDisplay: keyof T;
  searchProperties: string[];
  url: string;
  name?: string;
  value?: T[keyof T][];
  error?: string;
  onChange?: (values: T[keyof T][]) => void;
  onChangeFull?: (values: T[]) => void;
}

export const Autocomplete = <T,>({
  label,
  propertyToDisplay,
  propertyValue,
  searchProperties = [],
  url,
  value,
  name,
  error,
  onChange,
  onChangeFull,
}: AutocompleteProps<T>) => {
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
    if (
      value?.every((option) =>
        selected.some((item) => option === item[propertyValue]),
      )
    )
      return;
    loadInitialValues(value);
  }, [value]);

  useEffect(() => {
    onChange?.(selected.map((item) => item[propertyValue]));
    onChangeFull?.(selected);
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
        autoComplete="off"
        name={name}
        ref={inputRef}
        role="combobox"
        type="text"
        aria-autocomplete="list"
        aria-haspopup="listbox"
        error={error}
      ></Input>
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
