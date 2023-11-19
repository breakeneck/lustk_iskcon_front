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
  await useApi('/books/' + store.lang);
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
      <div v-for="lang of LANGUAGES" @click="setLang(lang)"  class="lang" :class="{active: store.lang == lang || false}" rounded  py-0 px-2>
        <country-flag :country="lang"/>
      </div>
    </div>
    <el-tree :props="treeProps" lazy :load="load" @node-click="click" :key="store.lang" />
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