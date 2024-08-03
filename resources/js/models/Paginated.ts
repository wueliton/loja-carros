export interface Paginated<T> {
  data: T[];
  current_page: number;
  first_page_url: string;
  from: number;
  last_page: number;
  links: {
    url?: string;
    label: string;
    active: boolean;
  }[];
  next_page_url?: string | null;
  path: string;
  prev_page_url?: string | null;
  to: number;
  total: number;
}
