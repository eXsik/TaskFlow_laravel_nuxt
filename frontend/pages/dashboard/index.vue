<template>
  <div>dashboard</div>
  <div>{{ data }}</div>
  <Overlay :onBoardCreated="refresh" />
</template>

<script setup lang="ts">
const { data, refresh } = await useAsyncData("boards", () =>
  useSanctumFetch(`/api/boards`)
);

definePageMeta({
  middleware: ["$auth"],
  layout: "panel",
});
</script>
