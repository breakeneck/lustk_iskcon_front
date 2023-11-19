// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
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
    apiUrl: '',
    public: {
      apiUrl: '',
    },
  },
  plugins: [
    '~/plugins/vueflags.ts'
  ]
})
