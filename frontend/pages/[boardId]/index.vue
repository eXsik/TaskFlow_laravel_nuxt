<template>
  <div>
    {{ boardId }}
    test
  </div>
</template>

<script setup lang="ts">
const { boardId } = useRoute().params;

definePageMeta({
  layout: "panel",
});
</script>
