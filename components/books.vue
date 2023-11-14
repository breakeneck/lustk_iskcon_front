<script setup lang="ts">
import type Node from 'element-plus/es/components/tree/src/model/node'

const emit = defineEmits(['chapterClick']);
const props = {
  isLeaf: 'leaf',
}
const books = await useApi('/books');

async function load(node: Node, resolve) {
  switch (node.level) {
    case 0:
      resolve(books);
      break;
    case 1:
      resolve(await useApi('/books/content/' + node.data.id))
      break;
    default:
      resolve(await useApi('/books/chapters/' + node.data.id))
      break;
  }
}


function click(node: Node) {
  if (node.id) {
    // console.log('click', node)
    emit('chapterClick', node)
  }
}
</script>

<template>
  <el-tree :data="books" :props="props" lazy :load="load" @node-click="click" />
</template>

<style scoped>

</style>