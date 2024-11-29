<template>
  <UCard>
    <div class="header text-center mb-4">
      <div class="flex justify-center">
        <Logo />
      </div>
    </div>
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
