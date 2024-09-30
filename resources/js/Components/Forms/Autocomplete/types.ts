import { Where } from '@/models/Filter';

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
  disabled?: boolean;
  autoFocus?: boolean;
  filter?: Where<T & Record<string, unknown>>[];
  className?: string;
  required?: boolean;
  onCreate?: (value: string) => Promise<T>;
  onChange?: (values: isMulti extends true ? T[keyof T][] : T[keyof T]) => void;
  onChangeFull?: (values: isMulti extends true ? T[] : T) => void;
}
