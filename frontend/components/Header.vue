<template>
  <header class="py-2 border-b dark:border-gray-700 bg-white dark:bg-gray-800">
    <UContainer>
      <div class="flex justify-between items-center">
        <NuxtLink to="/"><Logo /></NuxtLink>
        <div class="inline-flex justify-end gap-3 items-center">
          <NuxtLink to="/dashboard" class="text-sm font-semibold"
            >Dashboard</NuxtLink
          >
          <slot name="actions" />
          <ThemeToggle />
          <Dropdown v-if="user" />
        </div>
      </div>
    </UContainer>
  </header>
</template>

<script setup lang="ts">
const { user } = useSanctum();
</script>
