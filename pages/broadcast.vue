<script setup lang="ts">
const broadcasts = await useApi('/broadcast');
async function addEmptyRecord() {
  broadcasts.push(await useApi('/broadcast/create', {}))
}

async function save(broadcast) {
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
      <div flex gap-2>
        <el-date-picker v-model="broadcast.date" type="Date" value-format="YYYY-MM-DD"/>
        <lectors :user-id="broadcast.user_id" @update-user-id="(value) => broadcast.user_id = value"/>
        <el-button type="primary" @click="save(broadcast)">Save</el-button>
      </div>
      <select-shloka @add="(pageId) => insertShloka(broadcast.id, pageId)"/>
      <ul>
        <li v-for="page of broadcast.pages">
          <el-button @click="deleteShloka(broadcast.id, page.id)" size="small">
            <el-icon><el-icon-minus /></el-icon>
          </el-button>
          <strong>{{ formatPageAbbr(page) }}</strong>
          <span>{{ page.txt }}</span>
        </li>
      </ul>
    </div>
    <el-button @click="addEmptyRecord" to="#">New day</el-button>
  </div>

</template>

<style scoped>

</style>