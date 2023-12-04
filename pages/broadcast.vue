<script setup lang="ts">
import {usePageAbbr} from "~/composables/useFormat";

const pages = reactive([])

async function add(textId) {
  const {chapter, page} = await useApi('/books/page/' + textId);
  pages.push(page)
  // console.log('page', data)
}

definePageMeta({
  title: 'Broadcast',
  middleware: 'auth'
  // layout: 'profile',
});
</script>

<template>
  <select-shloka @add="add"/>
  <div>
    <ul>
      <li v-for="page of pages">
        <strong>{{usePageAbbr(page)}}</strong> {{page.txt}}
      </li>
    </ul>
  </div>
</template>

<style scoped>

</style>