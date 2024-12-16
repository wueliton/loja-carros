import { tv } from 'tailwind-variants';

const UploadAreaStyles = tv({
  slots: {
    container: 'flex items-center justify-center w-full text-gray-400',
    label:
      'flex flex-col items-center justify-center w-full gap-1 h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-blue-50 hover:text-blue-500 hover:border-blue-300 focus-within:text-blue-500 focus-within:bg-blue-50 focus-within:border-blue-300 active:bg-blue-100 active:text-blue-500 active:border-blue-300 transition-colors text-sm p-5 text-center',
    hint: 'text-xs uppercase',
    input: 'h-0 w-0 overflow-hidden',
  },
  variants: {
    dragActive: {
      true: {
        label: 'bg-blue-50 text-blue-500 border-blue-300 bg-blue-50',
      },
    },
  },
});

export { UploadAreaStyles };
