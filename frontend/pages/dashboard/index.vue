<template>
  <div>dashboard</div>
  <div>{{ data }}</div>
</template>

<script setup lang="ts">
definePageMeta({
  middleware: ["$auth"],
  layout: "panel",
});

const config = useRuntimeConfig();
const { data } = await useAsyncData("boards", () =>
  $fetch(`${config.public.laravelSanctum.apiUrl}/api/boards`)
);
</script>
