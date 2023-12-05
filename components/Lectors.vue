<script setup lang="ts">
const props = defineProps(['userId']);
const emit = defineEmits(['updateUserId']);

const users = await useApi('/users');
console.log('users', users)


const isAdding = ref(false)
const newUserName = ref('')

const onAddUser = () => {
  isAdding.value = true
}

const onConfirm = async () => {
  if (newUserName.value) {
    const user = await useApi('/users/create', {name: newUserName.value})
    users.push(user)
    clear()
  }
}

const model = computed({
  get() {
    return props.userId
  },
  set(newValue) {
    emit('updateUserId', newValue)
  }
})

const clear = () => {
  newUserName.value = ''
  isAdding.value = false
}
</script>

<template>
  <el-select v-model="model">
    <el-option v-for="user of users" :label="user.name" :value="user.id" :key="'user' + user.id" />
    <template #footer>
      <el-button v-if="! isAdding" text bg size="small" @click="onAddUser">Add new user</el-button>
      <template v-else>
        <el-input v-model="newUserName" placeholder="Name" size="small" />
        <el-button type="primary" size="small" @click="onConfirm">confirm</el-button>
        <el-button size="small" @click="clear">cancel</el-button>
      </template>
    </template>
  </el-select>
</template>

<style scoped>

</style>