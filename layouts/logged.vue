<script setup lang="ts">
const user = useUserStore();
function logout() {
  user.$reset();
  user.logoutRedirect();
}
</script>

<template>
  <div md:w-800px w-full m-a>
    <header v-if="user.isLogged" flex p-1>
      <div flex-1></div>
      <el-button type="primary" @click="logout()" >Logout</el-button>
    </header>
    <slot/>
  </div>
</template>

<style scoped>
header {
  background: #eaeaea;
}
</style>