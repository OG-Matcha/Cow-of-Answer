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
  app: {
    pageTransition: { name: 'page', mode: 'out-in' }
  },
})