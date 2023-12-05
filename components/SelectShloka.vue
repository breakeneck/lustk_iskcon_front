<script setup lang="ts">
const chapters = await useApi('/books/contents/11' )
const subchapters = reactive([])
const texts = reactive([])
const chapterId = ref(null)
const subchapterId = ref(null)
const textId = ref(null)

watch(chapterId, async () => {
  subchapters.length = 0;
  subchapters.push(...await useApi('/books/chapters/' + chapterId.value));
});
watch(subchapterId, async () => {
  texts.length = 0;
  texts.push(...await useApi('/books/texts/' + subchapterId.value));
});

const emit = defineEmits(['add'])
</script>

<template>
  <el-select v-model="chapterId" class="m-2" placeholder="Select Chapter">
    <el-option v-for="chapter in chapters" :label="chapter.label" :value="chapter.id" :key="chapter.id" />
  </el-select>
  <el-select v-model="subchapterId" class="m-2" placeholder="Select Subchapter" v-if="subchapters.length">
    <el-option v-for="subchapter in subchapters" :label="subchapter.label" :value="subchapter.id" :key="subchapter.id" />
  </el-select>
  <el-select v-model="textId" class="m-2" placeholder="Select Text" v-if="texts.length">
    <el-option v-for="text in texts" :label="text.label" :value="text.id" :key="text.id" />
  </el-select>

  <el-button @click="emit('add', textId)" v-if="textId">
    <el-icon> <el-icon-plus /> </el-icon>
  </el-button>
</template>

<style scoped>

</style>