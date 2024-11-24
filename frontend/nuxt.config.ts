// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: "2024-11-01",
  devtools: { enabled: true },
  modules: ["@nuxt/ui", "@qirolab/nuxt-sanctum-authentication"],
  devServer: {
    host: "laravel.test",
  },
  laravelSanctum: {
    apiUrl: "http://laravel.test",
    authMode: "cookie",
  },
});
