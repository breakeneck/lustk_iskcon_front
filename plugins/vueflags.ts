// import VueFlags from "@growthbunker/vueflags";
// import VueflagsEsm from "@growthbunker/vueflags/dist/vueflags.esm";

import CountryFlagEsm from "vue-country-flag-next/dist/country-flag.esm";

export default defineNuxtPlugin((nuxtApp) => {
    // nuxtApp.vueApp.use(VueflagsEsm);
    nuxtApp.vueApp.use(CountryFlagEsm);
})