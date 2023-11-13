<script setup lang="ts">
function loadPage(node) {
  ElMessage(node.id + ' ' + node.label)
}
</script>

<template>
  <books @chapter-click="loadPage"/>
</template>

<style scoped>

</style>