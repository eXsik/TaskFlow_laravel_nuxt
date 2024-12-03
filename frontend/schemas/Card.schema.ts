import { z } from "zod";

export default z.object({
  name: z.string().min(1).max(255),
  // list: z.array(z.string()).optional().nullable(),
});
