import axios, { AxiosError, CanceledError } from 'axios';
import imageCompression from 'browser-image-compression';
import { useEffect, useMemo, useState } from 'react';
import { v4 as uuidv4 } from 'uuid';
import { UploadFileConfig, UploadFileStatus } from './constants';
import {
  FileStateProps,
  InitialFilesProps,
  UploadFileProps,
  UseUploadFilesProps,
} from './types';

function useUploadFiles({
  accept,
  maxFiles = 1,
  url,
  initialFiles,
  onDelete,
  onChange,
}: UseUploadFilesProps) {
  const initialFilesIds = (initialFiles ?? []).map((item) => item.id);
  const [filesState, setFilesState] = useState<FileStateProps[]>([]);
  const validFiles = filesState.filter((file) =>
    [
      UploadFileStatus.COMPLETED,
      UploadFileStatus.PENDING,
      UploadFileStatus.FAILED,
    ].includes(file.status),
  ).length;
  const canUpdateFiles = validFiles < maxFiles;
  const filesUploadCount = `${validFiles}/${maxFiles}`;
  const convertedFilesToInitialFileType = useMemo<InitialFilesProps[]>(
    () =>
      filesState
        .filter((file) => [UploadFileStatus.COMPLETED].includes(file.status))
        .map((file, index) => ({
          name: file.name,
          order: index,
          ...(initialFilesIds.includes(file.id) ? { id: file.id } : {}),
        })),
    [filesState],
  );

  const handleAddFiles = (files: File[]) => {
    const remainingFiles = maxFiles - validFiles;
    const newFiles = files.slice(0, remainingFiles).map(
      (file): FileStateProps => ({
        file: file,
        id: uuidv4(),
        isLoading: true,
        status: UploadFileStatus.PENDING,
        cancelToken: axios.CancelToken.source(),
      }),
    );

    newFiles.forEach(({ file, id, cancelToken }) =>
      uploadFile({
        file,
        id,
        cancelToken,
      }),
    );

    setFilesState((prev) => [...prev, ...newFiles]);
  };

  const handleUpdateFile = (
    id: string,
    props: Partial<Omit<FileStateProps, 'id'>>,
  ) => {
    setFilesState((prev) =>
      prev.map((fileState) =>
        fileState.id === id ? { ...fileState, ...props } : fileState,
      ),
    );
  };

  const handleRetryFile = (file?: FileStateProps) => {
    if (!file) return;
    uploadFile({ file: file.file, id: file.id, cancelToken: file.cancelToken });
  };

  const handleRemoveFile = (id: string) => {
    setFilesState((prev) => prev.filter((item) => item.id !== id));
  };

  const handleDeleteFile = (file: FileStateProps, index: number) => {
    const fileProps: InitialFilesProps = {
      name: file.name,
      id: file.id,
      order: index,
    };

    onDelete?.(fileProps);
  };

  const uploadFile = async ({ file, id, cancelToken }: UploadFileProps) => {
    if (!file) {
      handleRemoveFile(id);
      return;
    }

    handleUpdateFile(id, {
      status: UploadFileStatus.PENDING,
      progress: 0,
    });

    try {
      if (accept?.includes('image')) {
        const compressedFile = await imageCompression(file, UploadFileConfig);
        file = compressedFile;
      }

      const formData = new FormData();
      formData.append('image', file);

      const data = await axios.post<{ name: string }>(route(url), formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
        onUploadProgress: (progressEvent) => {
          if (progressEvent.total) {
            const percent = Math.round(
              (progressEvent.loaded * 100) / progressEvent.total,
            );

            handleUpdateFile(id, { progress: percent });
          }
        },
        cancelToken: cancelToken?.token,
      });

      handleUpdateFile(id, {
        file: undefined,
        name: data.data.name,
        status: UploadFileStatus.COMPLETED,
      });
    } catch (err) {
      if (err instanceof AxiosError) {
        if (err.response?.status === 422) {
          handleUpdateFile(id, {
            status: UploadFileStatus.INVALID,
          });
          return;
        }
      }

      if (err instanceof CanceledError) {
        handleUpdateFile(id, {
          status: UploadFileStatus.CANCELED,
        });
        return;
      }

      handleUpdateFile(id, {
        status: UploadFileStatus.FAILED,
      });
    }
  };

  const handleCanDelete = (id: string) => initialFilesIds.includes(id);

  useEffect(() => {
    const initialFilesState = (initialFiles ?? []).map((file) => ({
      name: file.name,
      id: String(file.id),
      isLoading: true,
      status: UploadFileStatus.COMPLETED,
      order: file.order,
    }));
    setFilesState(initialFilesState);
  }, [initialFiles]);

  useEffect(() => {
    onChange?.(convertedFilesToInitialFileType);
  }, [convertedFilesToInitialFileType]);

  return {
    files: filesState,
    setFiles: setFilesState,
    canUpdateFiles,
    addFile: handleAddFiles,
    removeFile: handleRemoveFile,
    onRetry: handleRetryFile,
    deleteFile: handleDeleteFile,
    filesUploadCount,
    canDelete: handleCanDelete,
  };
}

export default useUploadFiles;
