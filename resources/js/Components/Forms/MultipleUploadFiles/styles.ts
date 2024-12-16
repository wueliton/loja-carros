import { tv } from 'tailwind-variants';

const MultipleUploadFilesStyle = tv({
  slots: {
    container: 'flex flex-col gap-3',
    fileList: 'flex flex-col gap-2',
    fileListTitle: 'text-md font-bold',
  },
});

export { MultipleUploadFilesStyle };
