<template>
  <WrapperDefault
    v-if="boardData"
    class="h-screen"
    :style="{
      backgroundImage: `url(${boardData?.image})`,
      backgroundSize: 'cover',
      backgroundPosition: 'center',
    }"
  >
    <template #button-actions>
      <UButton
        size="xs"
        icon="i-heroicons-outline:plus-sm"
        @click="handleCreateCard"
      >
        Create card
      </UButton>
    </template>

    <h1 class="text-3xl font-semibold mb-4 inline-block">
      {{ boardData.name }}
    </h1>

    <CardContainer :cards="boardData?.cards ?? []" :board-id="boardData?.id" />

    <OverlaysCard />
  </WrapperDefault>
  <div v-else class="text-center">Ładowanie...</div>
</template>

<script setup lang="ts">
import { useOverlayState } from "~/composable/useOverlayState";
import type { Board } from "~/types";

const { id: boardId } = useRoute().params;

definePageMeta({
  layout: "panel",
});

const {
  data: boardData,
  refresh,
  error,
} = await useAsyncData("boards", () =>
  useSanctumFetch<Board>(`/api/boards/${boardId}`)
);

if (error.value) {
  throw createError({
    statusCode: 404,
    message: "Board not found",
  });
}

provide("refresh-cards", refresh);

const { showOverlay } = useOverlayState();

const handleCreateCard = () => {
  showOverlay();
};
</script>
