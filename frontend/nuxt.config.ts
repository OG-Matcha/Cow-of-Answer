// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    experimental: { sharedPrerenderData: true },
    ssr: false,
    devtools: { enabled: false },
    modules: [
      '@nuxtjs/tailwindcss'
    ],  
    css: [
        './public/assets/css/tailwind.css'
    ],
    vite: {
      server: {
        watch: {
          usePolling: true, 
        },
      },
    },
    app: {
        pageTransition: { name: 'slide', mode: 'out-in' }
    },
})