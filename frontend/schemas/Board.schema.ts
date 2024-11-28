import { z } from "zod";

export default z.object({
  name: z.string().min(1).max(255),
  description: z.string().min(1).optional(),
  image: z.string().optional().nullable(),
  // list: z.array(z.string()).optional().nullable(),
});
