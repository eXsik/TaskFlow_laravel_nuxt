<template>
  <Header>
    <template #actions>
      <UButton
        size="xs"
        icon="i-heroicons-outline:plus-sm"
        @click="handleCreateBoard"
      >
        Create board
      </UButton>
    </template>
  </Header>
  <section
    class="h-[calc(100vh_-_80px)] flex items-center justify-center w-full"
  >
    <main class="mt-10 h-full">
      <UContainer>
        <slot />
      </UContainer>
    </main>
  </section>
  <UNotifications />
</template>

<script setup lang="ts">
import { useBoardState } from "~/composable/useBoardState";
import { useOverlayState } from "~/composable/useOverlayState";

const { clearSelectedBoard } = useBoardState();
const { showOverlay } = useOverlayState();

const handleCreateBoard = () => {
  clearSelectedBoard();
  showOverlay();
};
</script>
