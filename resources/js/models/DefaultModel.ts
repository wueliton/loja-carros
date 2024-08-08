export class DefaultModel {
  declare static ROUTE: string;
  static GET_ROUTE(params?: string | string[]) {
    return [this.ROUTE, ...(Array.isArray(params) ? params : [params])]
      .filter((path) => !!path)
      .join('.');
  }
  created_by?: number;
}
