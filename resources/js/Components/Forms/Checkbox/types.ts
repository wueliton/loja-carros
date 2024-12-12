import { InputHTMLAttributes, PropsWithChildren } from 'react';

interface CheckboxProps
  extends Omit<InputHTMLAttributes<HTMLInputElement>, 'type'>,
    PropsWithChildren {}

export type { CheckboxProps };
