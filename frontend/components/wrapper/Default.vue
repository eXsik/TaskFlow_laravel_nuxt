<template>
  <div>
    <Header>
      <template #actions>
        <slot name="button-actions" />
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
  </div>
</template>

<script setup lang="ts"></script>

<style></style>
