import { SpinIcon } from '@/Components/Icons/Spin';
import axios from 'axios';
import debounce from 'lodash/debounce';
import { ChangeEvent, useEffect, useRef, useState } from 'react';
import { Chip } from '../Chip';
import { Input } from '../Input';
import styles from './Autocomplete.module.scss';
import { AutocompleteMenu } from './Menu';

export interface AutocompleteProps<T> {
  label: string;
  propertyValue: keyof T;
  propertyToDisplay: keyof T;
  searchProperties: string[];
  url: string;
}

export const Autocomplete = <T,>({
  label,
  propertyToDisplay,
  propertyValue,
  searchProperties = [],
  url,
}: AutocompleteProps<T>) => {
  const [loading, setLoading] = useState(true);
  const [search, setSearch] = useState<string | null>(null);
  const [selected, setSelected] = useState<T[]>([]);
  const [opened, setOpened] = useState(false);
  const [options, setOptions] = useState<T[]>([]);
  const inputRef = useRef<HTMLDivElement | null>(null);

  const loadResults = async (inputSearch: string) => {
    if (inputSearch === search) return;
    setSearch(inputSearch);
    setLoading(true);
    const { data } = await axios.get<T[]>(url, {
      params: Object.fromEntries(
        searchProperties.map((key) => [key, inputSearch]),
      ),
    });
    setLoading(false);
    setOptions(data);
  };

  const handleOpendMenu = () => {
    setOpened(true);
  };

  const handleSelectOption = (item: T) => {
    setSelected((prev) => [...prev, item]);
    setOpened(false);
  };

  const handleRemoveOption = (item: T) => {
    setSelected((prev) => prev.filter((selected) => selected !== item));
  };

  const handleTabPressed = (e: React.KeyboardEvent<HTMLInputElement>) => {
    if (e.key.toLowerCase() !== 'tab') return;
    setOpened(false);
  };

  const debounceSearch = debounce(
    (e: ChangeEvent<HTMLInputElement>) => loadResults(e.target.value),
    1000,
  );

  useEffect(() => {
    loadResults('');
  }, []);

  return (
    <div className={styles.field}>
      <Input
        label={label}
        onChange={debounceSearch}
        onFocus={handleOpendMenu}
        onKeyDown={handleTabPressed}
        ref={inputRef}
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
      <AutocompleteMenu
        opened={opened}
        parent={inputRef}
        onClose={() => setOpened(false)}
      >
        {loading && (
          <div className={styles.loading}>
            <SpinIcon />
          </div>
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
      </AutocompleteMenu>
    </div>
  );
};
