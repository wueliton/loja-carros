import { FC } from 'react';
import { CheckboxProps } from './types';

export const Checkbox: FC<CheckboxProps> = ({ children, ...props }) => {
  return (
    <label className="flex items-center mb-4">
      <input
        {...props}
        type="checkbox"
        className="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 focus:ring-2"
      />
      <span className="ms-2 text-sm font-medium text-gray-900">{children}</span>
    </label>
  );
};
