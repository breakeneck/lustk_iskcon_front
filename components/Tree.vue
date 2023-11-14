<script setup lang="ts">
const emit = defineEmits(['chapterClick']);
interface Node {
  label: string,
  id?: number,
  children?: [],
}
const books = await useApi('/books/tree');

function click(node: Node) {
  if (node.id) {
    emit('chapterClick', node)
  }
}
</script>

<template>
  <el-tree :data="books" :props="Node" @node-click="click" />
</template>

<style scoped>

</style>