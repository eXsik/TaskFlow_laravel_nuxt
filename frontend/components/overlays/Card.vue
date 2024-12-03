<template>
  <USlideover :modelValue="isVisibleOverlay" @update:modelValue="hideOverlay">
    <OverlaysHeader :title="selectedCard ? 'Update card' : 'Create card'" />

    <FormsCardForm
      :type="selectedCard ? 'update' : 'create'"
      :initialData="selectedCard"
      :boardId="(boardId as string)"
      @createCard="refreshCards"
    >
    </FormsCardForm>
  </USlideover>
</template>

<script setup lang="ts">
import { useCardState } from "~/composable/useCardState";
import { useOverlayState } from "~/composable/useOverlayState";
const { id: boardId } = useRoute().params;

const { selectedCard } = useCardState();

const refreshCards = inject("refresh-cards") as () => void;

const { isVisibleOverlay, hideOverlay } = useOverlayState();
</script>
