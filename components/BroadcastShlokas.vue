<script setup lang="ts">
defineProps(['broadcast', 'showDelete'])
const emits = defineEmits(['deleteShloka'])
</script>

<template>
  <div flex gap-2>
    <div v-for="page of broadcast.pages" flex gap-2>
      <el-button type="danger" @click="emits('deleteShloka', broadcast.id, page.id)" size="small" v-if="showDelete">
        <el-icon><el-icon-minus /></el-icon>
      </el-button>
      <el-link :href="page.book.url + page.path" target="_blank">
        <strong>{{ formatPageAbbr(page) }}</strong>
      </el-link>
      <el-tooltip raw-content>
        <template #content> <div lg:w-600px w-300px>{{ page.txt }}</div> </template>
        <el-icon><el-icon-info-filled/></el-icon>
      </el-tooltip>
    </div>
  </div>
</template>

<style scoped>

</style>