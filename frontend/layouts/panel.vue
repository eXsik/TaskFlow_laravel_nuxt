<template>
  <Header>
    <template v-if="route.name === 'dashboard'" #actions>
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
    class="h-[calc(100vh_-_80px)] flex items-center justify-center max-w-7xl w-full mx-auto"
  >
    <main class="mt-10 h-full w-full">
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

const route = useRoute();

const handleCreateBoard = () => {
  clearSelectedBoard();
  showOverlay();
};
</script>
