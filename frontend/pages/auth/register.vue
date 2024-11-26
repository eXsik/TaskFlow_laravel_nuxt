<template>
  <UCard>
    <h1 class="text-xl font-bold mb-4 text-center">Sign Up for an Account</h1>
    <FormsRegisterForm />
  </UCard>
</template>

<script setup lang="ts">
definePageMeta({
  middleware: ["$guest"],
  layout: "auth",
});
</script>
