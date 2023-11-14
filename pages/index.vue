<script setup lang="ts">
import {toReactive} from "@vueuse/shared";

const isBooksVisible = ref(true);
const tabs = reactive([]);
const active = ref({label: '', id: 0, abbr: ''});
const activeTabId = ref(0)
function add(node) {
  tabs.push(node);
  activate(node.id)
}
function activate(id) {
  activeTabId.value = id;
  isBooksVisible.value = false;
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
}
</script>

<template>
  <header flex p-1>
    <el-button @click="showBooks()">
      <el-icon mr-2><el-icon-notebook /> </el-icon> Books
    </el-button>
    <div v-for="tab of tabs">
      <el-button @click="activate(tab.id)" :class="{active: tab.id == activeTabId}">
        {{tab.label}}
        <button @click="close(tab.id)">X</button>
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
  background: orange;
}
</style>