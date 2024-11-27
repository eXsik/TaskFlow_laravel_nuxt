<template>
  <Header>
    <template #actions>
      <UButton
        size="xs"
        icon="i-heroicons-outline:plus-sm"
        @click="showOverlay()"
      >
        Create board
      </UButton>
    </template>
  </Header>
  <section
    class="h-[calc(100vh_-_80px)] flex items-center justify-center w-full"
  >
    <main class="my-2">
      <UContainer>
        <slot />
      </UContainer>
    </main>
  </section>
  <UNotifications />
</template>

<script setup lang="ts">
import { useOverlayState } from "~/composable/useOverlayState";

const { showOverlay } = useOverlayState();
</script>
