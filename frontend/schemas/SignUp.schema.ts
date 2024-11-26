import { z } from "zod";
import SignInSchema from "./SignIn.schema";

export default SignInSchema.extend({
  name: z.string().min(3).max(50),
  password_confirmation: z.string().min(8),
}).refine((data) => data.password === data.password_confirmation, {
  message: "Passwords do not match.",
  path: ["password_confirmation"],
});
