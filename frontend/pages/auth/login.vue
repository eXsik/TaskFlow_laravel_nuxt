<template>
  <UCard>
    <h1 class="text-xl font-bold mb-4 text-center">Sign In to Your Account</h1>
    <FormsLoginForm />
  </UCard>
</template>

<script setup lang="ts">
definePageMeta({
  middleware: ["$guest"],
  layout: "auth",
});
</script>
