<template>
  <USlideover :modelValue="modelValue" @update:modelValue="updateModelValue">
    Hello
  </USlideover>
</template>

<script setup lang="ts">
// Oczekujemy propsa 'modelValue' przekazanego z rodzica
const props = defineProps<{
  modelValue: boolean; // Przekazujemy modelValue
}>();

// Emitujemy zdarzenie 'update:modelValue', aby zaktualizować wartość w rodzicu
const emit = defineEmits<{
  (event: "update:modelValue", value: boolean): void;
}>();

// Funkcja do obsługi zmiany wartości
const updateModelValue = (value: boolean) => {
  emit("update:modelValue", value);
};
</script>

<style></style>
