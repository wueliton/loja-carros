import { useEffect, useRef, useState } from 'react';
import { useIMask } from 'react-imask';

export interface MaskProps {
  value?: string;
  mask?: unknown;
}

export const useMask = ({ value: inputValue, mask }: MaskProps) => {
  if (!mask) {
    const [value, setValue] = useState<string>(inputValue ?? '');
    const inputRef = useRef<HTMLInputElement>(null);

    const handleChangeValue = (e: Event) => {
      setValue((e.target as HTMLInputElement).value);
    };

    useEffect(() => {
      if (!inputRef.current) return;
      inputRef.current.addEventListener('input', handleChangeValue);

      return () =>
        inputRef.current?.removeEventListener('input', handleChangeValue);
    }, [inputRef]);

    return { ref: inputRef, value, setValue, unmaskedValue: value };
  }

  const maskProps = useIMask({
    mask: mask as string,
    dispatch: (_, dynamicMasked) => {
      const value = dynamicMasked.value;
      return dynamicMasked.compiledMasks.find(
        (m) =>
          (
            m as unknown as { comparison: (value: string) => boolean }
          ).comparison?.(value) ?? true,
      );
    },
  });

  return maskProps;
};
