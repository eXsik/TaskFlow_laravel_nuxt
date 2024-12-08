<template>
  <div>
    <draggable
      :list="cards"
      handle=".list-handle"
      item-key="id"
      :scroll-sensitivity="500"
      :force-fallback="true"
      ghost-class="ghost-board"
      drag-class="dragging-board"
      class="flex gap-4 h-[80vh] overflow-x-auto pb-4"
      @sort="handleSort"
    >
      <template #item="{ element }">
        <div class="flex">
          <div
            class="w-72 shadow bg-white dark:bg-gray-800 rounded flex flex-col"
          >
            <CardHeader :title="element.name" />
            <div class="list-body px-4 py-2 flex-1 overflow-y-hidden">
              {{ element }}
            </div>

            <div class="p-1 border-t dark:border-gray-700 flex items-center">
              <UButton block> Add ticket</UButton>
            </div>
          </div>
        </div>
      </template>
    </draggable>
  </div>
</template>

<script setup lang="ts">
import draggable from "vuedraggable";
import type { Board, Card } from "~/types";

interface Props {
  cards: Card[];
  boardId: string;
}

const props = defineProps<Props>();

async function handleSort(event: CustomEvent) {
  const handleSortForm = useSanctumForm("put", `/api/boards/${props.boardId}`, {
    cards: props.cards.flatMap((item) => item.id),
  });

  await handleSortForm.submit();
}
</script>

<style>
.ghost-board > div {
  @apply opacity-50;
}

.ghost-board > div > div {
  @apply invisible;
}

.dragging-board {
  @apply shadow-2xl transform rotate-2 !cursor-grab;
}
.sortable-chosen {
  opacity: 1 !important;
}
</style>
