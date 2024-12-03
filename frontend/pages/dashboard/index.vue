<template>
  <WrapperDefault>
    <template #button-actions>
      <UButton
        size="xs"
        icon="i-heroicons-outline:plus-sm"
        @click="handleCreateBoard"
      >
        Create board
      </UButton>
    </template>
    <BoardList :boards="data ?? []" />
    <OverlaysBoard />
  </WrapperDefault>
</template>

<script setup lang="ts">
import type { Board } from "~/types";

const { data, refresh } = await useAsyncData<Board[]>("boards", () =>
  useSanctumFetch(`/api/boards`)
);

provide("refresh-boards", refresh);

definePageMeta({
  middleware: ["$auth"],
  layout: "panel",
});

import { useBoardState } from "~/composable/useBoardState";
import { useOverlayState } from "~/composable/useOverlayState";

const { clearSelectedBoard } = useBoardState();
const { showOverlay } = useOverlayState();

const handleCreateBoard = () => {
  clearSelectedBoard();
  showOverlay();
};
</script>
