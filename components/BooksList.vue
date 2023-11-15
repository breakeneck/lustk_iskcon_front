<script setup lang="ts">
import type Node from 'element-plus/es/components/tree/src/model/node'
import {LANGUAGES} from "~/composables/constants";

const store = useBookStore()

const treeProps = {
  isLeaf: 'isLeaf',
}
async function load(node: Node, resolve) {
  switch (node.level) {
    case 0:
      resolve(await useApi('/books/' + store.lang));
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
  <span v-for="lang of LANGUAGES" p-2>
<!--    <country-flag :country='lang' size='big' @click="setLang(lang)" cursor-pointer/>-->
    <a href="#" @click="setLang(lang)">{{lang}}</a>
  </span>
  <el-tree :props="treeProps" lazy :load="load" @node-click="click" />
</template>

<style scoped>

</style>