<template>
  <UForm
    :state="formState"
    class="space-y-3"
    :schema="SignUpSchema"
    @submit.prevent="handleRegister"
  >
    <UFormGroup
      name="name"
      label="Full name"
      required
      :error="errors?.name?.length > 0 ? true : undefined"
    >
      <UInput type="text" v-model="formState.name" icon="i-heroicons-user" />
      <p v-if="errors.name" class="mt-2 text-red-500 dark:text-red-400 text-sm">
        {{ errors.name[0] }}
      </p>
    </UFormGroup>

    <UFormGroup
      name="email"
      label="Email"
      required
      :error="errors?.email?.length > 0 ? true : undefined"
    >
      <UInput
        type="email"
        v-model="formState.email"
        icon="i-heroicons-at-symbol"
        autocomplete="email"
      />

      <p
        v-if="errors.email"
        class="mt-2 text-red-500 dark:text-red-400 text-sm"
      >
        {{ errors.email[0] }}
      </p>
    </UFormGroup>

    <UFormGroup name="password" label="Password" required>
      <UInput
        type="password"
        v-model="formState.password"
        icon="i-heroicons-lock-closed"
        autocomplete="current-password"
      />
      <p
        v-if="errors.password"
        class="mt-2 text-red-500 dark:text-red-400 text-sm"
      >
        {{ errors.password[0] }}
      </p>
    </UFormGroup>
    <UFormGroup name="password_confirmation" label="Confirm password" required>
      <UInput
        type="password"
        v-model="formState.password_confirmation"
        icon="i-heroicons-lock-closed"
        autocomplete="current-password"
      />

      <p
        v-if="errors.password_confirmation"
        class="mt-2 text-red-500 dark:text-red-400 text-sm"
      >
        {{ errors.password_confirmation[0] }}
      </p>
    </UFormGroup>

    <UButton type="submit" block :loading="isLoading">Sign Up</UButton>
  </UForm>
  <p class="mt-10 text-center text-sm/6 text-gray-500">
    Already have an account?
    <NuxtLink
      to="/auth/login"
      class="font-semibold text-primary-600 hover:text-primary-500"
    >
      Sign in.
    </NuxtLink>
  </p>
</template>

<script setup lang="ts">
import SignUpSchema from "~/schemas/SignUp.schema";
import type { ValidationError } from "~/types/api";
import { FetchError } from "ofetch";

const { refreshUser } = useSanctum();
const errors = ref<ValidationError>({});
const isLoading = ref<boolean>(false);

const formState = reactive({
  name: undefined,
  email: undefined,
  password: undefined,
  password_confirmation: undefined,
});

const handleRegister = async () => {
  isLoading.value = true;
  errors.value = {};

  try {
    await useSanctumFetch("/api/register", {
      method: "POST",
      body: formState,
    });

    await refreshUser();

    useToast().add({
      icon: "i-octicon-check-circle",
      title: "Account Created!",
      description: "Your account has been created successfully!",
      timeout: 5000,
    });

    return navigateTo("/dashboard");
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
