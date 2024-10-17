import { tv } from 'tailwind-variants';

export const infoBlockMessageStlyes = tv({
  slots: {
    container: 'p-5 rounded flex gap-3 items-center',
    icon: 'p-1 rounded-full',
  },
  variants: {
    color: {
      success: {
        container: 'bg-green-100',
        icon: 'bg-green-300',
      },
      important: {
        container: 'bg-orange-100',
        icon: 'bg-orange-300',
      },
      info: {
        container: 'bg-blue-100',
        icon: 'bg-blue-300',
      },
    },
  },
  defaultVariants: {
    color: 'info',
  },
});
