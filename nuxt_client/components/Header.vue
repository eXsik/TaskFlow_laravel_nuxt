<template>
  <header class="container mx-auto max-w-7xl py-4">
    <nav class="flex items-center justify-between text-white gap-4">
      <NuxtLink to="/">Home</NuxtLink>
      <div class="flex gap-4">
        <NuxtLink to="/auth/login">Login</NuxtLink>
        <NuxtLink to="/auth/register">Register</NuxtLink>
      </div>
    </nav>
  </header>
</template>

<script setup lang="ts"></script>

<style></style>
