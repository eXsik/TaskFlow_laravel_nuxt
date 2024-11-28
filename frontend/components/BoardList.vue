<template>
  <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <UCard
      v-for="board in boards"
      :key="board.id"
      class="text-center bg-white dark:bg-gray-800"
      @click="() => handleSelectBoard(board)"
    >
      {{ board.name }}
    </UCard>
  </div>
</template>

<script setup lang="ts">
import { useBoardState } from "~/composable/useBoardState";
import { useOverlayState } from "~/composable/useOverlayState";
import type { Board } from "~/types";

defineProps<{
  boards?: Board[] | null | undefined;
}>();

const { showOverlay } = useOverlayState();
const { selectBoard } = useBoardState();

const handleSelectBoard = (board: Board) => {
  selectBoard(board);
  showOverlay();
};
</script>
