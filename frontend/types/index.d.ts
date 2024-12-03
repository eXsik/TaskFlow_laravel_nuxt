export interface User {
  id: number;
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

export interface Card {
  id: string;
  name: string;
  tickets: [];
  board_id: number;
  owner_id: number;
  created_at: string;
  updated_at: string;
}
