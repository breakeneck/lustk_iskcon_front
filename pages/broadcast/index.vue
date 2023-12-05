<script setup lang="ts">
const broadcasts = await useApi('/broadcast');
</script>

<template>

  <div p-10>

    <el-table :data="broadcasts" style="width: 100%">
      <el-table-column prop="date" label="Date" width="180" />
      <el-table-column prop="user.name" label="Name" width="180" />
      <el-table-column label="Shlokas" width="180">
        <template #default="scope">
          <broadcast-shlokas :broadcast="scope.row" />
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<style scoped>

</style>