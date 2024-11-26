<script setup lang="ts">
const colorMode = useColorMode();
const isDark = computed({
  get() {
    return colorMode.value === "dark";
  },
  set() {
    colorMode.preference = colorMode.value === "dark" ? "light" : "dark";
  },
});
</script>

<template>
  <ClientOnly>
    <UButton
      :icon="isDark ? 'i-heroicons-outline:moon' : 'i-heroicons-outline:sun'"
      color="gray"
      variant="ghost"
      aria-label="Theme"
      @click="isDark = !isDark"
      size="xl"
      class="p-2"
    />
    <template #fallback>
      <div class="size-6" />
    </template>
  </ClientOnly>
</template>
