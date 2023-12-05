<script setup lang="ts">
defineProps(['broadcast'])
const emits = defineEmits(['deleteShloka'])
</script>

<template>
  <div flex gap-2>
    <div v-for="page of broadcast.pages" flex gap-2>
      <el-button type="danger" @click="emits('deleteShloka', broadcast.id, page.id)" size="small">
        <el-icon><el-icon-minus /></el-icon>
      </el-button>
      <strong>{{ formatPageAbbr(page) }}</strong>
      <el-tooltip placement="top" raw-content>
        <template #content> <div style="width:200px">{{ page.txt }}</div> </template>
        <el-icon><el-icon-info-filled/></el-icon>
      </el-tooltip>
    </div>
  </div>
</template>

<style scoped>

</style>