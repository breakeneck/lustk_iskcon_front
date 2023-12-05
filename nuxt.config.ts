// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: false },
  modules: [
    // '@anu-vue/nuxt',
    '@element-plus/nuxt',
    '@unocss/nuxt',
    '@pinia/nuxt',
    '@pinia-plugin-persistedstate/nuxt',
  ],
  elementPlus: {},
  // anu: {
  //   // options
  // },
  // ssr: false,
  css: [
      '@unocss/reset/normalize.css',
      '@unocss/reset/sanitize/sanitize.css',
      '@unocss/reset/sanitize/assets.css',
  ],
  runtimeConfig: {
    public: {
      apiUrl: 'https://iskcon-lutsk.duckdns.org/api',
    },
  },
  plugins: [
    '~/plugins/vueflags.ts'
  ],
  // ssr: false,
  routeRules: {
    '/broadcast': {ssr: true},
  },
})
