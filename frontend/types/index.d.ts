export interface User {
  name: string;
  email: string;
}

export interface Board {
  id: string;
  name: string;
  description: string | undefined;
  owner_id: number;
  image: string;
  created_at: string;
  updated_at: string;
}
