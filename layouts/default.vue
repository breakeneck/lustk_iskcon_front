<script setup lang="ts">
const user = useUserStore();
function logout() {
  user.$reset();
  user.logoutRedirect();
}
</script>

<template>
  <header v-if="user.isLogged">
    <h1>Hello {{user.model.name}}!</h1>
    <el-button type="primary" @click="logout()">Logout</el-button>
  </header>
  <slot />
</template>

<style scoped>

</style>