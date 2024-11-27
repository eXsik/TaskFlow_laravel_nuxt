<template>
  <header class="p-2 border-b dark:border-gray-700 bg-white dark:bg-gray-800">
    <UContainer>
      <div class="flex justify-between items-center">
        <NuxtLink to="/"><Logo /></NuxtLink>
        <div class="inline-flex justify-end gap-2 items-center">
          <NuxtLink to="/dashboard">Dashboard</NuxtLink>
          <slot name="actions" />
          <ThemeToggle />
          <Dropdown />
        </div>
      </div>
    </UContainer>
  </header>
</template>

<script setup lang="ts"></script>
