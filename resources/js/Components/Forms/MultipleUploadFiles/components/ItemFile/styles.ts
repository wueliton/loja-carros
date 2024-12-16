import { tv } from 'tailwind-variants';

const ItemFileStyles = tv({
  slots: {
    container:
      'flex flex-col gap-2 rounded-md overflow-hidden p-2 pl-7 relative cursor-move select-none',
    content: 'flex flex-row gap-2 items-center',
    icon: 'rounded-md border-2 border-white h-12 w-12 [&>img]:object-cover [&>img]:w-full [&>img]:h-full',
    titleContainer: 'overflow-hidden w-full',
    title: 'text-black overflow-hidden text-ellipsis',
    subtitle: 'text-black/60 uppercase text-xs',
    progressBar: 'w-full bg-gray-300 rounded-full h-2 mt-2',
    progressIndicator: 'bg-blue-600 h-2 rounded-full',
    dragIndicator:
      'absolute left-0 top-0 h-full w-5 bg-gray-200 flex items-center text-gray-400',
    counter: 'min-w-5 text-center font-bold text-gray-300',
  },
  variants: {
    status: {
      pending: {
        container: 'border border-gray-200 bg-white',
      },
      completed: {
        container: 'bg-gray-100/60',
      },
      failed: {
        container: 'border border-red-100 bg-red-50',
        title: 'text-red-600',
      },
      canceled: {
        container: 'border border-red-100 bg-red-50',
        title: 'text-red-600 line-through',
        subtitle: 'line-through',
      },
    },
  },
});

export { ItemFileStyles };
