// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  experimental: { sharedPrerenderData: true },
  ssr: false,
  devtools: { enabled: false },
  modules: [
    '@nuxtjs/tailwindcss'
  ],
  vite: {
    server: {
      watch: {
        usePolling: true, 
      },
    },
  },
  runtimeConfig: {
    // Keys within public, will be also exposed to the client-side
    public: {
      apiURL: 'http://localhost:8000'
    }
  },
  app: {
    pageTransition: { name: 'page', mode: 'out-in' }
  },
})