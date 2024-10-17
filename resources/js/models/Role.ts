export interface Role {
  id: number;
  name: 'admin' | 'super' | 'user';
  guard_name: string;
}
