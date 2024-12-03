<template>
  <div
    class="shadow-lg dark:bg-gray-800 rounded overflow-hidden relative w-full h-full"
  >
    <div class="h-36 w-full relative z-[1]">
      <NuxtLink
        :to="{
          name: 'boards-id',
          params: { id: board.id },
        }"
      >
        <NuxtImg
          :src="board.image"
          :alt="board.name"
          class="w-full h-full object-cover absolute z-[1]"
        />
      </NuxtLink>
    </div>

    <div class="flex flex-col p-2">
      <div class="flex justify-between items-center">
        <h3 class="font-semibold text-sm h-full">
          {{ board.name }}
        </h3>

        <UDropdown :items="actions">
          <UIcon
            name="i-heroicons-outline:dots-vertical"
            class="text-primary size-5 hover:text-primary-500 transition"
          />
        </UDropdown>
      </div>
      <div class="h-full w-full my-1">
        <p class="text-xs">
          {{ board.description }}
        </p>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useBoardState } from "~/composable/useBoardState";
import { useOverlayState } from "~/composable/useOverlayState";
import type { Board } from "~/types";

const props = defineProps<{
  board: Board;
}>();

const actions = ref([
  [
    {
      label: "Edit",
      icon: "i-heroicons-pencil",
      click: () => handleSelectBoard(props.board),
    },
  ],
  [
    {
      label: "Delete",
      icon: "i-heroicons-trash",
      click: () => {},
    },
  ],
]);

const { showOverlay } = useOverlayState();
const { selectBoard } = useBoardState();

function handleSelectBoard(board: Board) {
  selectBoard(board);
  showOverlay();
}
</script>
