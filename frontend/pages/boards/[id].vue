<template>
  <WrapperDefault>
    <template #button-actions>
      <UButton
        size="xs"
        icon="i-heroicons-outline:plus-sm"
        @click="handleCreateCard"
      >
        Create card
      </UButton>
    </template>
    siema
    {{ BoardData }}
    <OverlaysCard />
  </WrapperDefault>
</template>

<script setup lang="ts">
import { useOverlayState } from "~/composable/useOverlayState";

const { id: boardId } = useRoute().params;

definePageMeta({
  layout: "panel",
});

const { data: BoardData, refresh } = await useAsyncData("boards", () =>
  useSanctumFetch(`/api/boards/${boardId}`)
);

provide("refresh-cards", refresh);

const { showOverlay } = useOverlayState();

const handleCreateCard = () => {
  showOverlay();
};
</script>
