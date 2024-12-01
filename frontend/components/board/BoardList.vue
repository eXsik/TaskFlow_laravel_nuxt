<template>
  <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <BoardItem v-for="board in boards" :key="board.id" :board="board" />
  </div>
</template>

<script setup lang="ts">
import type { Board } from "~/types";

defineProps<{
  boards?: Board[] | null | undefined;
}>();
</script>
