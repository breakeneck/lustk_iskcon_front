<script setup lang="ts">
const node = ref({label: '', id: 0});
</script>

<template>
<!--  <el-popover placement="right" :width="400" trigger="click">-->
<!--    <template #reference>-->
<!--      <el-button style="margin-right: 16px">Click to activate</el-button>-->
<!--    </template>-->
    <books @chapter-click="(val) => node = val"/>
    <book-page :node="node"/>
</template>

<style scoped>
header {
  background: #eaeaea;
}
</style>