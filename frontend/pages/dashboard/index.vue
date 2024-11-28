<template>
  <BoardList :boards="data" />
  <Overlay :onBoardCreated="refresh" />
</template>

<script setup lang="ts">
import type { Board } from "~/types";

const { data, refresh } = await useAsyncData<Board[]>("boards", () =>
  useSanctumFetch(`/api/boards`)
);

definePageMeta({
  middleware: ["$auth"],
  layout: "panel",
});
</script>
