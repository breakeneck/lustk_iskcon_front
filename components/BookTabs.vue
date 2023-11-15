<script setup lang="ts">
const isBooksVisible = ref(true);
const store = useBookStore();
const activeTabId = ref(0)

const isMounted = ref(false);
onMounted(() => isMounted.value = true)

function add(node) {
  const isExist = findIndex(node.id);
  if (! isExist) {
    store.tabs.push(node);
  }
  activate(node.id)
}
function activate(id) {
  activeTabId.value = id;
  isBooksVisible.value = false;
}
function close(id) {
  store.tabs.splice(findIndex(id), 1);
  isBooksVisible.value = true;
}
function showBooks() {
  isBooksVisible.value = true;
  activeTabId.value = 0;
}

const findIndex = (id) => {
  for(let index = 0; index < store.tabs.length; index++) {
    if (store.tabs[index].id == id) {
      return index;
    }
  }
  return 0;
}
</script>

<template>
  <header flex p-1>
    <el-button @click="showBooks()" :class="{active: isBooksVisible}">
      <el-icon mr-2><el-icon-notebook /> </el-icon> Books
    </el-button>
    <div v-for="tab of store.tabs">
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

    <div v-for="tab of store.tabs" :key="tab.id" v-show="! isBooksVisible" v-if="isMounted">
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