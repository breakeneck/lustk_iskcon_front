<script setup lang="ts">

const books = reactive([]);
const loading = ref(false);

const {data} = useGet('/books/test');
books.push(...data.value);
async function load() {
  books.length = 0;
  loading.value = true;
  const response = useGet('/books');
  const {data} = await response;
  loading.value = false;
  books.push(...data.value.books);
  console.log('after', data.value.books);
}

definePageMeta({
  middleware: ['auth'],
});
</script>

<template>
  <el-button @click="load()" :loading="loading">Load</el-button>
  <ul>
    <li v-for="book of books">{{book.title}}</li>
  </ul>
</template>

<style scoped>

</style>