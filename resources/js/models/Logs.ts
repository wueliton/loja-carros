export class Logs {
  batch_uuid?: string;
  causer_id?: number;
  causer_type?: string;
  created_at?: string;
  description?: string;
  event?: 'created' | 'updated' | 'deleted';
  id?: number;
  log_name?: string;
  subject_id?: number;
  subject_types?: string;
  updated_at?: string;
}

export enum ACTION {
  created = 'Criou',
  updated = 'Atualizou',
  deleted = 'Deletou',
}

export class CustomLog {
  created_at?: string;
  event!: keyof typeof ACTION;
  id?: number;
  model?: string;
  title?: string;
  user?: string;
}
