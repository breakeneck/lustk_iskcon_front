<script setup lang="ts">
import type Node from 'element-plus/es/components/tree/src/model/node'

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


const emit = defineEmits(['chapterClick']);
function click(node: Node) {
  if (node.isLeaf) {
    emit('chapterClick', node)
  }
}
</script>

<template>
  <div v-loading="isLoading">
    <book-langs />
    <el-tree :props="treeProps" lazy :load="load" @node-click="click" :key="store.lang" />
  </div>
</template>