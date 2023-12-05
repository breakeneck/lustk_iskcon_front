<script setup lang="ts">
const broadcasts = await useApi('/broadcast');
async function create() {
  broadcasts.push(await useApi('/broadcast/create', {}))
}

async function update(broadcast) {
  await useApi('/broadcast/update', broadcast)
}

async function insertShloka(broadcastId, pageId) {
  const broadcast = await useApi('/broadcast/insert-shloka', {broadcastId, pageId});
  broadcasts.splice(getIndex(broadcastId), 1, broadcast);
}
async function deleteShloka(broadcastId, pageId) {
  const broadcast = await useApi('/broadcast/delete-shloka', {broadcastId, pageId});
  broadcasts.splice(getIndex(broadcastId), 1, broadcast);
}

const getIndex = (id) => {
  return broadcasts.map(e => e.id).indexOf(id);
}

definePageMeta({
  title: 'Broadcast',
  middleware: 'auth'
  // layout: 'profile',
});
</script>

<template>

  <div p-10>
    <div v-for="broadcast of broadcasts">
      <select-shloka @add="(pageId) => insertShloka(broadcast.id, pageId)"/>
      <div flex gap-2>
        <el-date-picker v-model="broadcast.date" type="Date" value-format="YYYY-MM-DD"/>
        <lectors :user-id="broadcast.user_id" @update-user-id="(value) => broadcast.user_id = value"/>
        <broadcast-shlokas :broadcast="broadcast" show-delete="true" @delete-shloka="deleteShloka"/>

        <el-button type="primary" @click="update(broadcast)">Save</el-button>
      </div>
    </div>
    <el-button @click="create" to="#">New day</el-button>
  </div>

</template>

<style scoped>

</style>