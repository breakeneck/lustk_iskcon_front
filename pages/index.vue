<script setup lang="ts">
const node = ref({label: '', id: 0});
const books = await useApi('/books');
</script>

<template>
  <el-popover placement="right" :width="400" trigger="click">
    <template #reference>
      <el-button style="margin-right: 16px">Click to activate</el-button>
    </template>
    <books-list :books="books" @chapter-click="(val) => node = val"/>
  </el-popover>
  <book-page :node="node"/>
</template>

<style scoped>
header {
  background: #eaeaea;
}
</style>