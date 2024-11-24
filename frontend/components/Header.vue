<template>
  <header class="container mx-auto max-w-7xl">
    <nav class="flex justify-between items-center p-6">
      <div>
        <NuxtLink to="/">Home</NuxtLink>
      </div>
      <div>
        <ul class="flex items-center gap-4">
          <template v-if="isLoggedIn">
            <li v-if="user">Hello user {{ user.name }}</li>
            <li>
              <button @click.prevent="handleLogout">Logout</button>
            </li>
          </template>
          <template v-else>
            <li>
              <NuxtLink to="/auth/register">Register</NuxtLink>
            </li>
            <li>
              <NuxtLink to="/auth/login">Login</NuxtLink>
            </li>
          </template>
        </ul>
      </div>
    </nav>
  </header>
</template>

<script setup lang="ts">
interface User {
  name: string;
  email: string;
}

const { isLoggedIn, user, logout } = useSanctum<User>();

const handleLogout = () => {
  logout();
};
</script>
