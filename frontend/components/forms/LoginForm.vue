<template>
  <UForm
    :state="formState"
    class="space-y-3"
    :schema="SignInSchema"
    @submit.prevent="handleSubmit"
  >
    <UFormGroup
      name="email"
      label="Email"
      :error="errors?.email?.length > 0 ? true : undefined"
    >
      <UInput
        type="email"
        v-model="formState.email"
        icon="i-heroicons-at-symbol"
        autocomplete="email"
      />
    </UFormGroup>

    <UFormGroup
      name="password"
      label="Password"
      :error="errors?.email?.length > 0 ? true : undefined"
    >
      <UInput
        type="password"
        v-model="formState.password"
        icon="i-heroicons-lock-closed"
        autocomplete="current-password"
      />

      <p
        v-if="errors.email"
        class="mt-2 text-red-500 dark:text-red-400 text-sm"
      >
        {{ errors.email[0] }}
      </p>
    </UFormGroup>

    <UButton type="submit" block :loading="isLoading">Sign In</UButton>
  </UForm>

  <p class="mt-10 text-center text-sm/6 text-gray-500">
    Don't have an account?
    <NuxtLink
      to="/auth/register"
      class="font-semibold text-primary-600 hover:text-primary-500"
      >Sign up.
    </NuxtLink>
  </p>
</template>

<script setup lang="ts">
import SignInSchema from "~/schemas/SignIn.schema";
import { FetchError } from "ofetch";
import type { ValidationError } from "~/types/api";

const { login } = useSanctum();
const formState = reactive({
  email: undefined,
  password: undefined,
});
const isLoading = ref<boolean>(false);
const errors = ref<ValidationError>({});

const handleSubmit = async () => {
  isLoading.value = true;

  try {
    await login(formState);

    useToast().add({
      icon: "i-heroicons-check-circle",
      title: "Welcome!",
      description: "You have successfully logged in",
      timeout: 5000,
    });
  } catch (e) {
    const fetchError = e as FetchError;
    if (fetchError && fetchError.response?.status === 422) {
      errors.value = fetchError.response._data.errors;
    }

    console.error(fetchError);
  } finally {
    isLoading.value = false;
  }
};
</script>
