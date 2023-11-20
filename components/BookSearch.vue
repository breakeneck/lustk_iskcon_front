<script setup lang="ts">
import Node from "element-plus/es/components/tree/src/model/node";

const searchInput = ref('');
const isLoading = ref(false);
const pages = reactive([]);
async function search() {
  pages.value = [];

  isLoading.value = true;
  const data = await useApi('/books/search/' + searchInput.value);
  isLoading.value = false;

  pages.push(...data);
}


function click(page) {
  let node = {
    id: page.id,
    abbr: page.book.alias + ' ' + page.path.replace(/^\/|\/$/g, '').replace(/\//g, '.')
  }
  emit('chapterClick', node)
}
const emit = defineEmits(['chapterClick']);
</script>

<template>
  <div v-loading="isLoading">
    <el-input v-model="searchInput" placeholder="Search" @keyup.enter="search()"/>
    <ul>
      <li v-for="page of pages" :key="page.id">
        <el-link type="primary" href="#" @click="click(page)">
          <strong>{{page.book.alias}} {{page.path.replace(/^\/|\/$/g, '').replace(/\//g, '.')}}</strong>
        </el-link>
        <span ml-1>{{page.txt}}</span>
      </li>
    </ul>
  </div>
</template>

<style scoped>

</style>