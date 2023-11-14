<script setup lang="ts">
interface Node {
  label: string,
  id: number
}

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

watch(() => props.node, async (first, second) => {
  if (props.node.id) {
    ElMessage(props.node.id + ' ' + props.node.id)
    const data = await useApi('/books/page/' + props.node.id);
    Object.assign(page, data.page);
    Object.assign(chapter, data.chapter);
  }
});

async function loadPage(node) {
  ElMessage(node.id + ' ' + node.label)
  const data = await useApi('/books/page/' + node.id);
  Object.assign(page, data.page);
  Object.assign(chapter, data.chapter);
  // console.log('page',chapter, page);
}

// console.log('props.page', props.page);
</script>

<template>
<div pb-10>
  <h1>{{chapter.title}}</h1>
  <el-row>
    <code>{{page.sanskrit}}</code>
  </el-row>
  <el-row>
  <i>{{page.wordly}}</i>
  </el-row>
  <el-row>
  <strong>{{page.txt}}</strong>
  </el-row>
  <div>{{page.comment}}</div>
</div>
</template>

<style scoped>

</style>