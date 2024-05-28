import { FC, useCallback } from 'react';

const errorMessages = {
  'validation.email': 'E-mail inválido',
  'validation.numeric': 'Campo precisa ser do tipo numérico',
  'validation.required': 'O campo é obrigatório',
};

export const Error: FC<{ error: string; fieldName: string }> = ({
  error,
  fieldName,
}) => {
  const getErrorMessage = useCallback(
    (error: string, field: string) => {
      const errorKey = error as keyof typeof errorMessages;
      if (!errorMessages[errorKey]) return error;
      return errorMessages[errorKey].replaceAll(':fieldName', field);
    },
    [error, fieldName],
  );

  return <>{getErrorMessage(error, fieldName)}</>;
};
