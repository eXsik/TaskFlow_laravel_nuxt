<template>
  <USlideover :modelValue="isVisibleOverlay" @update:modelValue="hideOverlay">
    <OverlayHeader title="Create a board" />
    <FormsBoardForm type="create" @createBoard="onBoardCreated" />
  </USlideover>
</template>

<script setup lang="ts">
import { useOverlayState } from "~/composable/useOverlayState";

const { isVisibleOverlay, hideOverlay } = useOverlayState();

defineProps<{
  onBoardCreated?: () => void;
}>();
</script>
