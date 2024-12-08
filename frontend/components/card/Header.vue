<template>
  <div
    class="px-4 py-2 border-b border-b-primary flex items-center justify-between list-handle cursor-move"
  >
    <h3 class="font-medium">
      {{ title }}
    </h3>

    <UDropdown :items="cardActions">
      <UIcon name="i-heroicons-outline:dots-vertical" class="text-primary" />
    </UDropdown>
  </div>
</template>

<script setup lang="ts">
import { cardActionsItems } from "~/constants";

defineProps<{
  title: string;
}>();

const cardActions = ref(cardActionsItems);
</script>
