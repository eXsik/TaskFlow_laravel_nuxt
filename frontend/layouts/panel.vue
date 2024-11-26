<template>
  <Header>
    <template #actions>
      <UButton
        size="xs"
        icon="i-heroicons-outline:plus-sm"
        @click="handleShowBoard(true)"
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
        <Overlay
          :modelValue="showCreateBoard"
          @update:modelValue="handleShowBoard"
        />
      </UContainer>
    </main>
  </section>
  <UNotifications />
</template>

<script setup lang="ts">
const showCreateBoard = ref<boolean>(false);

const handleShowBoard = (value: boolean) => {
  showCreateBoard.value = value;
};
</script>
