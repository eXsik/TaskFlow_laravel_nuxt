<template>
  <Header />
  <section
    class="h-[calc(100vh_-_80px)] flex items-center justify-center w-full"
  >
    <slot />
  </section>
  <UNotifications />
</template>

<script setup lang="ts"></script>
