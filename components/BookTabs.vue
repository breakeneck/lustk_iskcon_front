<script setup lang="ts">
import {isNumber} from "lodash-es";

const BOOK_TAB = 'book';
const SEARCH_TAB = 'search';
const ITEM_TAB = 'item';

const active = reactive({type: BOOK_TAB, itemId: 0});
const store = useBookStore();

const isMounted = ref(false);
onMounted(() => isMounted.value = true)

function add(node) {
  const isExist = findIndex(node.id);
  if (! isExist) {
    store.tabs.push(node);
  }
  activate(node.id)
}
function activate(value) {
  if (isNumber(value)) {
    active.type = ITEM_TAB
    active.itemId = value;
  }
  else {
    active.type = value;
  }
}

function isActive(value) {
  if (isNumber(value)) {
    return active.itemId === value;
  }
  return active.type === value;
}

function close(id) {
  store.tabs.splice(findIndex(id), 1);
  activate(BOOK_TAB);
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
    <el-button @click="activate(BOOK_TAB)" :class="{active: isActive(BOOK_TAB)}">
      <el-icon mr-2><el-icon-notebook /> </el-icon> Books
    </el-button>
    <el-button @click="activate(SEARCH_TAB)" :class="{active: isActive(SEARCH_TAB)}" mr-2>
      <el-icon><el-icon-search /> </el-icon>
    </el-button>
    <div v-for="tab of store.tabs">
      <el-button @click="activate(tab.id)" :class="{active: isActive(tab.id)}" plain>
        {{tab.abbr}}
        <el-icon ml-1 v-if="isActive(tab.id)">
          <ElIconCircleCloseFilled @click="close(tab.id)" text-rose-400/>
        </el-icon>
      </el-button>
    </div>
  </header>
  <div class="tabs">
    <books-list @chapter-click="add" v-show="isActive(BOOK_TAB)"/>

    <div v-show="isActive(SEARCH_TAB)">
      <el-input placeholder="Search"/>
      <div>Results here</div>
    </div>

    <div v-for="tab of store.tabs" :key="tab.id" v-show="isActive(ITEM_TAB)" v-if="isMounted">
      <book-page :node="tab" v-show="isActive(tab.id)" />
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