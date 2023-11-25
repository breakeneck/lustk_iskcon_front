<script setup lang="ts">
const userStore = useUserStore();

const email = ref('');
const password = ref('');

async function login() {
  const {user, error} = await useApi('/login', {email, password});
  if (error) {
    ElMessage({
      showClose: true,
      message: error,
      type: 'error',
    })
  }
  else {
    userStore.saveAuth(user);
    useRouter().push('/broadcast');
  }
}
async function logout() {
  const result = await useApi('/logout');
  console.log(result);
}

</script>

<template>
<div class="center-screen">
  <form flex flex-col gap-2 onsubmit="login()">
<!--    <el-alert type="error" v-if="error" :closable="false">-->
<!--      {{error}}-->
<!--    </el-alert>-->
    <el-row>
      <el-input v-model="email" placeholder="Email"/>
    </el-row>
    <el-row>
      <el-input v-model="password" placeholder="Password"/>
    </el-row>
    <el-row flex flex-self-end>
      <el-button type="primary" @click="login()">Login</el-button>
    </el-row>
  </form>
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