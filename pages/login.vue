<script setup lang="ts">
import {useUserStore} from "~/stores/user";

const email = ref('');
const password = ref('');
const error = ref('')
const user = useUserStore();

async function login() {
  const { data } = await usePost('/login', {email, password});
  error.value = data.value.error;
  if (! error.value) {
    ElMessage(`User ${data.value.user.name} is logged in successfully`);
  }
}

</script>

<template>
<div class="center-screen">
  <div flex flex-col gap-2>
    <el-alert type="error" v-if="error" :closable="false">
      {{error}}
    </el-alert>
    <el-row>
      <el-input v-model="email" placeholder="Email"/>
    </el-row>
    <el-row>
      <el-input v-model="password" placeholder="Password"/>
    </el-row>
    <el-row flex flex-self-end>
      <el-button type="primary" @click="login()">Login</el-button>
    </el-row>
  </div>
</div>
</template>

<style scoped>
.center-screen {
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  min-height: 100vh;
  width: 300px;
  margin: auto;
}
</style>