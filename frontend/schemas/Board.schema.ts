import { z } from "zod";

export default z.object({
  name: z.string().min(1).max(255),
  description: z.string().optional(),
  image: z.string().optional(),
  // cards: z.array(z.string()).optional().nullable(),
});
