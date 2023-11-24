<script setup lang="ts">
const chapters = await useApi('/books/contents/11' )
const chapterId = ref(null)


definePageMeta({
  title: 'Broadcast',
  middleware: 'auth'
  // layout: 'profile',
});
</script>

<template>
  <el-select v-model="chapterId" class="m-2" placeholder="Select Chapter" size="large" onselect="">
    <el-option v-for="chapter in chapters" :label="chapter.label" :value="chapter.id"/>
  </el-select>
</template>

<style scoped>

</style>