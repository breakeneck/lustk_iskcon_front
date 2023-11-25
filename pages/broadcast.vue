<script setup lang="ts">
const chapters = await useApi('/books/contents/11' )
const subchapters = reactive([])
const texts = reactive([])
const chapterId = ref(null)
const subchapterId = ref(null)
const textId = ref(null)

const pages = reactive([])

watch(chapterId, async () => {
    subchapters.length = 0;
    subchapters.push(...await useApi('/books/chapters/' + chapterId.value));
});
watch(subchapterId, async () => {
    texts.length = 0;
    texts.push(...await useApi('/books/chapters/' + subchapterId.value));
});

async function add() {
  const {chapter, page} = await useApi('/books/page/' + textId.value);
  pages.push(page)
  // console.log('page', data)
}

definePageMeta({
  title: 'Broadcast',
  middleware: 'auth'
  // layout: 'profile',
});
</script>

<template>
  <el-select v-model="chapterId" class="m-2" placeholder="Select Chapter" size="large">
    <el-option v-for="chapter in chapters" :label="chapter.label" :value="chapter.id"/>
  </el-select>
  <el-select v-model="subchapterId" class="m-2" placeholder="Select Subchapter" size="large" v-if="subchapters.length">
    <el-option v-for="subchapter in subchapters" :label="subchapter.label" :value="subchapter.id"/>
  </el-select>
  <el-select v-model="textId" class="m-2" placeholder="Select Text" size="large" v-if="texts.length">
    <el-option v-for="text in texts" :label="text.label" :value="text.id"/>
  </el-select>
  <el-button type="primary" @click="add()" v-if="textId">
    <el-icon> <el-icon-plus /> </el-icon>
  </el-button>

  <div>
    <ul>
      <li v-for="page of pages">
        <strong>{{page.path}}</strong> {{page.txt}}
      </li>
    </ul>
  </div>
</template>

<style scoped>

</style>