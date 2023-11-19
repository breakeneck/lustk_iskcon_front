<script setup lang="ts">
const props = defineProps(['node']);

const chapter = reactive({
  book_id: 0,
  id: 0,
  title: 'Not selected'
});

const page = reactive({
  sanskrit: '',
  wordly: '',
  txt: '',
  comment: '',
});

const isLoading = ref(false);
const mounted = ref(false);
onMounted(() => mounted.value = true)

// onUnmounted(() => {
watchEffect(async () => {
  // console.log('props.node', props.node);
  if (props.node.id > 0) {
    isLoading.value = true;
    await nextTick();
    const data = await useApi('/books/page/' + props.node.id);
    isLoading.value = false;

    Object.assign(page, data.page);
    Object.assign(chapter, data.chapter);
  }
});
// })
</script>

<template>
<div pb-10 lg:px-20 px-5 v-loading="isLoading">
  <el-row>
  <h1>{{chapter.title}}</h1>
  </el-row>
  <el-row>
    <code>{{page.sanskrit}}</code>
  </el-row>
  <el-row>
    <i>{{page.wordly}}</i>
  </el-row>
  <el-row>
    <strong>{{page.txt}}</strong>
  </el-row>
  <el-row>
    {{page.comment}}
  </el-row>
</div>
</template>

<style scoped>
.el-row {
  padding: 10px 0;
}
</style>