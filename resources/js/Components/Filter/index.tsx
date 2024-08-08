/* eslint-disable @typescript-eslint/no-explicit-any */
import { Where } from '@/models/Filter';
import { convertToFormData } from '@/utils/convert_to_form_data';
import { router } from '@inertiajs/react';
import { debounce } from 'lodash';
import {
  ChangeEvent,
  PropsWithChildren,
  createContext,
  useContext,
  useRef,
  useState,
} from 'react';
import { Input } from '../Forms/Input';
import { SearchIcon } from '../Icons/Search';
import styles from './Filter.module.scss';

export interface FilterContextProps {
  setFilter: (filter: { [k in string]: unknown }) => void;
}

const FilterContext = createContext<FilterContextProps>(
  {} as FilterContextProps,
);

export const useFilter = () => {
  const context = useContext(FilterContext);
  if (!context) return { setFilter: () => {} };
  return context;
};

export const Filter = ({
  children,
  searchProperties,
}: PropsWithChildren<{
  searchProperties: string[];
}>) => {
  const [inputValue, setInputValue] = useState<string>();
  const [customFilter, setCustomFilter] =
    useState<{ [k in string]: unknown }>();
  const inputFilter = useRef<Where<any>[]>();
  const filter = useRef<{ [k in string]: unknown }>();

  const handleFilterChange = (newFilter: { [k in string]: unknown }) => {
    if (JSON.stringify(customFilter) === JSON.stringify(newFilter)) return;

    setCustomFilter(newFilter);

    filter.current = Object.assign({}, filter.current, newFilter);
    reload();
  };

  const debounceSearch = debounce((e: ChangeEvent<HTMLInputElement>) => {
    if (inputValue === e.target.value) return;

    setInputValue(e.target.value);

    inputFilter.current = e.target.value
      ? searchProperties.map((prop) => ({
          fieldName: prop,
          value: e.target.value,
          comparison: 'contains',
        }))
      : [];
    reload();
  }, 500);

  const reload = () => {
    router.visit((route().current() ?? '').split('?')[0], {
      data: convertToFormData({
        where: inputFilter.current,
        ...filter.current,
      }),
      method: 'get',
      preserveScroll: true,
      preserveState: true,
    });
  };

  return (
    <FilterContext.Provider value={{ setFilter: handleFilterChange }}>
      <div className={styles.filter}>
        <div className="flex gap-2">{children}</div>
        <Input
          label=""
          className={styles.input}
          placeholder="Pesquisar"
          suffix={
            <div className="min-w-8 text-gray-400">
              <SearchIcon />
            </div>
          }
          onChange={debounceSearch}
        />
      </div>
    </FilterContext.Provider>
  );
};
