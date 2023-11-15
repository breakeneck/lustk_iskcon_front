<script setup lang="ts">
const isBooksVisible = ref(true);
const tabs = reactive([]);
onMounted(() => tabs.push(...useBookStore().tabs));

const active = ref({label: '', id: 0, abbr: ''});
const activeTabId = ref(0)
function add(node) {
  const isExist = findIndex(node.id);
  if (! isExist) {
    tabs.push(node);
  }
  activate(node.id)
}
function activate(id) {
  activeTabId.value = id;
  isBooksVisible.value = false;
  console.log()
}
function close(id) {
  tabs.splice(findIndex(id), 1);
  isBooksVisible.value = true;
}
function showBooks() {
  isBooksVisible.value = true;
  activeTabId.value = 0;
}

const findIndex = (id) => {
  for(let index = 0; index < tabs.length; index++) {
    if (tabs[index].id == id) {
      return index;
    }
  }
  return 0;
}
</script>

<template>
  <header flex p-1>
    <el-button @click="showBooks()">
      <el-icon mr-2><el-icon-notebook /> </el-icon> Books
    </el-button>
    <div v-for="tab of tabs">
      <el-button @click="activate(tab.id)" :class="{active: tab.id == activeTabId}" plain>
        {{tab.abbr}}
        <el-icon ml-1 v-if="tab.id == activeTabId">
          <ElIconCircleCloseFilled @click="close(tab.id)" text-rose-400/>
        </el-icon>
      </el-button>
    </div>
  </header>
  <div class="tabs">
    <books-list @chapter-click="add" v-show="isBooksVisible"/>

    <div v-for="tab of tabs" :key="tab.id" v-show="! isBooksVisible">
      <book-page :node="tab" v-show="tab.id == activeTabId" />
    </div>
  </div>
</template>

<style scoped>
header {
  background: #eaeaea;
}
.active {
  color: var(--el-button-active-text-color);
  border-color: var(--el-button-active-border-color);
  outline: 0;
  background: rgb(236, 245, 255);
}
</style>