<template>
  <UDropdown :items="dropdownItems">
    <UIcon name="i-heroicons-user" class="size-6 p-2 inline-block" />
    <template #profile>
      <div class="text-left">
        <p>Signed in as</p>
        <p class="truncate font-medium text-gray-900 dark:text-white">
          {{ user?.email }}
        </p>
      </div>
    </template>
  </UDropdown>
</template>

<script setup lang="ts">
import type { User } from "~/types";

const { user, logout } = useSanctum<User>();
const dropdownItems = ref([
  [
    {
      label: "Profile",
      slot: "profile",
      disabled: true,
    },
  ],
  [
    {
      label: "Billing",
      icon: "i-heroicons-credit-card",
      click: () => {},
    },
  ],
  [
    {
      label: "Sign Out",
      icon: "i-heroicons-arrow-left-on-rectangle",
      click: handleSignOut,
    },
  ],
]);

async function handleSignOut() {
  await logout();
  navigateTo("/");
}
</script>
