/* eslint-disable @typescript-eslint/no-explicit-any */
import {
  FC,
  PropsWithChildren,
  createContext,
  useContext,
  useMemo,
  useState,
} from 'react';
import { useFilter } from '../Filter';
import styles from './ToggleTabs.module.scss';

export type ToggleTabProps<T = unknown> = {
  value?: T;
  fieldName?: string;
  onChange?: (value: T) => void;
};

type ToggleTabContextProps<T> = {
  value?: T;
  onChange: (value: T) => void;
};

const toggleTabContext = createContext<ToggleTabContextProps<any>>(
  {} as ToggleTabContextProps<any>,
);

const useToggleTab = () => {
  return useContext(toggleTabContext);
};

export const ToggleTabs = <T,>({
  children,
  fieldName,
  onChange,
}: PropsWithChildren<ToggleTabProps<T>>) => {
  const [value, setValue] = useState<T>();
  const { setFilter } = useFilter();
  const handleChange = (newValue: T) => {
    setValue(newValue);
    onChange?.(newValue as T);
    setFilter({
      [fieldName!]: newValue,
    });
  };

  return (
    <toggleTabContext.Provider value={{ value, onChange: handleChange }}>
      <div className="flex gap-2">{children}</div>
    </toggleTabContext.Provider>
  );
};

export const ToggleTab: FC<PropsWithChildren<{ value?: unknown }>> = ({
  value: tabValue,
  children,
}) => {
  const { value, onChange } = useToggleTab();
  const isActive = useMemo(() => value === tabValue, [value, tabValue]);

  return (
    <button
      className={`${styles.tab} ${isActive ? styles.active : ''}`}
      onClick={() => onChange(tabValue)}
    >
      {children}
    </button>
  );
};
