<script setup lang="ts">
import {LANGUAGES} from "~/composables/constants";
const store = useBookStore()

async function setLang(lang: string) {
  store.lang = lang;
  await useApi('/books/' + store.lang);
}
</script>

<template>

  <div flex gap-2 m-1>
    <div v-for="lang of LANGUAGES" @click="setLang(lang)"  class="lang" :class="{active: store.lang == lang || false}" rounded  py-0 px-2>
      <country-flag :country="lang"/>
    </div>
  </div>
</template>

<style scoped>
.lang {
  cursor: pointer;
  border-width: 1px;
  border-style: solid;
  border-color: #e4e7ed;
}
.active {
  color: var(--el-button-active-text-color);
  border-color: #409eff;
  outline: 0;
  background: rgb(236, 245, 255);
}
</style>