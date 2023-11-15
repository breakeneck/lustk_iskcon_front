<script setup lang="ts">
import type Node from 'element-plus/es/components/tree/src/model/node'
import {LANGUAGES} from "~/composables/constants";

const store = useBookStore()
const isLoading = ref(false);

const treeProps = {
  isLeaf: 'isLeaf',
}
async function load(node: Node, resolve) {
  switch (node.level) {
    case 0:
      isLoading.value = true;
      resolve(await useApi('/books/' + store.lang));
      isLoading.value = false;
      break;
    case 1:
      resolve(await useApi('/books/contents/' + node.data.id))
      break;
    default:
      if (! node.isLeaf) {
        resolve(await useApi('/books/chapters/' + node.data.id))
      }
      break;
  }
}

async function setLang(lang) {
  store.lang = lang;
  const books = await useApi('/books/' + store.lang);
}

const emit = defineEmits(['chapterClick']);
function click(node: Node) {
  if (node.isLeaf) {
    emit('chapterClick', node)
  }
}
</script>

<template>
<!--  bg-light-blue-100 rounded-->
  <div v-loading="isLoading">
    <div flex gap-2 m-1>
      <div v-for="lang of LANGUAGES" @click="setLang(lang)" cursor-pointer rounded bg-warmgray-100 py-0 px-2>
        <country-flag  :country="lang"/>
      </div>
    </div>
    <el-tree :props="treeProps" lazy :load="load" @node-click="click" :key="store.lang || null" />
  </div>
</template>

<style scoped>

</style>