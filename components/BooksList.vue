<script setup lang="ts">
import type Node from 'element-plus/es/components/tree/src/model/node'

const props = defineProps(['books']);

const books = await useApi('/books');

const treeProps = {
  isLeaf: 'isLeaf',
}
// const books = await useApi('/books');
async function load(node: Node, resolve) {
  switch (node.level) {
    case 0:
      console.log('books', node)
      resolve(books);
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
    console.log('click', node)
    emit('chapterClick', node)
  }
}
</script>

<template>
  <el-tree :data="books" :props="treeProps" lazy :load="load" @node-click="click" />
</template>

<style scoped>

</style>