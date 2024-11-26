// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: "2024-11-01",
  devtools: { enabled: true },
  modules: ["@nuxt/ui", "@qirolab/nuxt-sanctum-authentication"],
  devServer: {
    host: "laravel.test",
  },
  ui: {},
  laravelSanctum: {
    apiUrl: "http://laravel.test",
    authMode: "cookie",
    redirect: {
      enableIntendedRedirect: false,
      loginPath: "/auth/login",
      redirectToAfterLogin: "/dashboard",
      redirectToAfterLogout: "/",
      guestOnlyRedirect: "/dashboard",
    },
    sanctumEndpoints: {
      csrf: "/sanctum/csrf-cookie",
      login: "/api/login",
      logout: "/api/logout",
      user: "/api/user",
    },
  },
});
