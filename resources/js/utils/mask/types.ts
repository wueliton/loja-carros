import { Mask } from './mask';

type ObtainMethods<T> = {
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  [K in keyof T]: T[K] extends (...args: any[]) => any ? K : never;
}[keyof T];

type MaskOptions = ObtainMethods<typeof Mask>;

export type { MaskOptions };
