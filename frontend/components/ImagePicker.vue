<template>
  <ol
    v-if="data?.hits"
    class="grid grid-cols-4 gap-2 overflow-y-auto overflow-x-auto h-64 p-2"
  >
    <li
      v-for="image in data.hits"
      class="h-12 relative rounded overflow-hidden cursor-pointer outline outline-transparent focus:outline-primary-500 hover:outline-primary-500"
      :class="{
        'ring-2 ring-primary-500 shadow': modelValue === image.largeImageUrl,
      }"
      :key="image.id"
      @click="$emit('update:modelValue', image.largeImageUrl)"
    >
      <NuxtImg
        :src="image.previewURL"
        class="w-full h-full object-cover absolute"
      >
      </NuxtImg>
    </li>
  </ol>
</template>

<script setup lang="ts">
const {
  public: { pixabayApiKey },
} = useRuntimeConfig();

defineProps<{
  modelValue?: string;
}>();

const { data } = useFetch<any>(
  `https://pixabay.com/api/?key=${pixabayApiKey}&image_type=photo&orientation=horizontal&per_page=32`
);
defineEmits<{ (e: "update:modelValue", value: string): void }>();
</script>
