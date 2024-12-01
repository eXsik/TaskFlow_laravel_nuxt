<template>
  <div>
    {{ boardId }}
    {{ data }}
    test
  </div>
</template>

<script setup lang="ts">
const { boardId } = useRoute().params;

definePageMeta({
  layout: "panel",
});

const { data } = await useAsyncData("boards", () =>
  useSanctumFetch(`/api/boards/${boardId}`)
);
</script>
