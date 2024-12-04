<template>
  <WrapperDefault
    v-if="data"
    class="h-screen"
    :style="{
      backgroundImage: `url(${data?.image})`,
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
      {{ data.name }}
    </h1>

    <CardContainer :cards="data.cards" :board-id="data?.id" />

    <OverlaysCard />
  </WrapperDefault>
  <div v-else class="text-center">Ładowanie...</div>
</template>

<script setup lang="ts">
import { useOverlayState } from "~/composable/useOverlayState";
import type { Board } from "~/types";

const { id: boardId } = useRoute().params;

const { data, refresh, error } = await useAsyncData<Board>("boards", () =>
  useSanctumFetch(`/api/boards/${boardId}`)
);

provide("refresh-cards", refresh);

definePageMeta({
  layout: "panel",
});

if (error.value) {
  throw createError({
    statusCode: 404,
    message: "Board not found",
  });
}

const { showOverlay } = useOverlayState();

const handleCreateCard = () => {
  showOverlay();
};
</script>
