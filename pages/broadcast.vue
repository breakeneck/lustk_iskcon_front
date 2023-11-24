<script setup lang="ts">
const chapters = await useApi('/books/contents/11' )
const texts = reactive([])
const chapterId = ref(null)
const textId = ref(null)

watch(chapterId, async (oldChapterId, newChapterId) => {
  console.log('newChapterId', newChapterId);
  if (newChapterId) {
    const data = await useApi('/books/chapters/' + newChapterId);
    console.log('texts', data);
    texts.push(...data);
  }
});
  // ElMessage('Chapter id ' + chapterId)
// }

definePageMeta({
  title: 'Broadcast',
  middleware: 'auth'
  // layout: 'profile',
});
</script>

<template>
  <el-select v-model="chapterId" class="m-2" placeholder="Select Chapter" size="large" onchange="selectChapter()">
    <el-option v-for="chapter in chapters" :label="chapter.label" :value="chapter.id"/>
  </el-select>
  <el-select v-model="textId" class="m-2" placeholder="Select Chapter" size="large" onchange="selectText()">
    <el-option v-for="text in texts" :label="text.label" :value="text.id"/>
  </el-select>
</template>

<style scoped>

</style>