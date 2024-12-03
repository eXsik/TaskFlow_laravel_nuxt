<template>
  <USlideover :modelValue="isVisibleOverlay" @update:modelValue="hideOverlay">
    <OverlaysHeader
      :title="selectedBoard ? 'Update Board' : 'Create a board'"
    />
    <FormsBoardForm
      :type="selectedBoard ? 'update' : 'create'"
      :initial-data="selectedBoard"
      @createBoard="refreshBoards"
    />
  </USlideover>
</template>

<script setup lang="ts">
import { useBoardState } from "~/composable/useBoardState";
import { useOverlayState } from "~/composable/useOverlayState";

const { isVisibleOverlay, hideOverlay } = useOverlayState();
const { selectedBoard } = useBoardState();

const refreshBoards = inject("refresh-boards") as () => void;
</script>
