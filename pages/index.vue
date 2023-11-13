<script setup lang="ts">
definePageMeta({
  middleware: ['auth'],
});
</script>

<template>
  <h1>Index</h1>
  <nuxt-link to="login">
    Login
  </nuxt-link>
</template>

<style scoped>

</style>