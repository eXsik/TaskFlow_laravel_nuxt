<template>
  <div class="flex flex-col items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 space-y-3 bg-gray-700 shadow-lg rounded-xl">
      <h1 class="text-2xl font-bold text-center">Register</h1>
      <form @submit.prevent="">
        <div class="flex flex-col space-y-1">
          <label for="name" class="text-sm font-medium">Name</label>
          <input
            id="name"
            type="name"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
          />
          <!-- <span class="text-sm text-red-600" v-if="errors.email">
            {{ errors.email[0] }}
          </span> -->
        </div>
        <div class="flex flex-col space-y-1">
          <label for="email" class="text-sm font-medium">Email</label>
          <input
            id="email"
            type="email"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
          />
          <!-- <span class="text-sm text-red-600" v-if="errors.email">
            {{ errors.email[0] }}
          </span> -->
        </div>

        <div class="flex flex-col mt-3 space-y-1">
          <label for="password" class="text-sm font-medium">Password</label>
          <input
            id="password"
            type="password"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
          />
          <!-- <span class="text-sm text-red-600" v-if="errors.password">
            {{ errors.password[0] }}
          </span> -->
        </div>

        <div class="flex flex-col mt-3 space-y-1">
          <label for="password_confirmation" class="text-sm font-medium"
            >Confirm password</label
          >
          <input
            id="password_confirmation"
            type="password_confirmation"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
          />
          <!-- <span class="text-sm text-red-600" v-if="errors.password">
            {{ errors.password[0] }}
          </span> -->
        </div>

        <button
          type="submit"
          class="w-full px-4 py-2 mt-3 text-sm font-medium text-white bg-blue-500 rounded-md"
        >
          Register
        </button>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts"></script>
