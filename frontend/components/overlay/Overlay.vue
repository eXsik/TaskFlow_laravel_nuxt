<template>
  <USlideover :modelValue="isVisibleOverlay" @update:modelValue="hideOverlay">
    <OverlayHeader :title="selectedBoard ? 'Update Board' : 'Create a board'" />
    <FormsBoardForm
      :type="selectedBoard ? 'update' : 'create'"
      :initial-data="selectedBoard"
      @createBoard="onBoardCreated"
    />
  </USlideover>
</template>

<script setup lang="ts">
import { useBoardState } from "~/composable/useBoardState";
import { useOverlayState } from "~/composable/useOverlayState";

const { isVisibleOverlay, hideOverlay } = useOverlayState();
const { selectedBoard } = useBoardState();

defineProps<{
  onBoardCreated?: () => void;
}>();
</script>
