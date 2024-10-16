export type Filter<T> = {
  where?: {
    [k in 'and' | 'or']?: Where<T>[];
  };
  global?: boolean;
};

export type Where<T, Value extends keyof T = keyof T> = {
  fieldName: Value;
  comparison: 'contains' | 'equals' | 'ninq' | 'inq';
  value: T[Value];
};
