import { FC, useCallback } from 'react';
import styles from './Error.module.scss';

const errorMessages = {
  'validation.email': 'E-mail inválido',
  'validation.numeric': 'Campo precisa ser do tipo numérico',
  'validation.required': 'O campo é obrigatório',
  'validation.uploaded': 'Tamanho do arquivo não permitido',
  'validation.mimes': 'Extensão do arquivo não permitida',
};

export const ErrorLabel: FC<{ error?: string; fieldName?: string }> = ({
  error,
  fieldName,
}) => {
  const getErrorMessage = useCallback(
    (error?: string, field?: string) => {
      const errorKey = error as keyof typeof errorMessages;
      if (!errorMessages[errorKey]) return error;
      return errorMessages[errorKey].replaceAll(':fieldName', field ?? '');
    },
    [error, fieldName],
  );

  return (
    <span className={styles.error}>{getErrorMessage(error, fieldName)}</span>
  );
};
