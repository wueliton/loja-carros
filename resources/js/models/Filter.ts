export interface Filter<T> {
  where?: Where<T>[];
}

export type Where<T, Value extends keyof T = keyof T> = {
  fieldName: Value;
  comparison: 'contains' | 'equals' | 'ninq' | 'inq';
  value: T[Value];
};
