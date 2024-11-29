<template>
  <UForm
    :state="form"
    :schema="BoardSchema"
    class="space-y-4 px-4 py-2"
    @submit.prevent="submit"
  >
    <UFormGroup name="name" label="Name">
      <UInput v-model="form.name" />
    </UFormGroup>

    <UFormGroup name="image" label="Cover image">
      <ImagePicker v-model="form.image" />
    </UFormGroup>

    <UFormGroup name="description" label="Description">
      <UInput v-model="form.description" />
    </UFormGroup>

    <UButton type="submit" block :loading="form.processing">
      {{ type === "update" ? "Update" : "Create" }}
    </UButton>
  </UForm>
</template>

<script setup lang="ts">
import { useBoardState } from "~/composable/useBoardState";
import { useOverlayState } from "~/composable/useOverlayState";
import BoardSchema from "~/schemas/Board.schema";
import type { Board } from "~/types";

interface BoardFormProps {
  type: "create" | "update";
  initialData: Board | null;
  onCreate?: () => void;
  onUpdate?: () => void;
}

const emit = defineEmits<{
  (e: "createBoard"): void;
}>();

const props = defineProps<BoardFormProps>();
const { hideOverlay } = useOverlayState();
const { clearSelectedBoard } = useBoardState();

const form = useSanctumForm(
  props.type === "update" ? "put" : "post",
  props.type === "update"
    ? `/api/boards/${props.initialData?.id}`
    : `/api/boards`,
  {
    name: props.initialData?.name || "",
    description: props.initialData?.description || "",
    image: props.initialData?.image || "",
  }
);

const submit = () => {
  form
    .submit()
    .then((response) => {
      emit("createBoard");
      form.reset();

      useToast().add({
        icon: "i-heroicons-check-circle",
        title: `Board ${props.type === "update" ? "updated" : "created"}!`,
        description: `Your board has been ${
          props.type === "update" ? "updated" : "created"
        } successfully!`,
        timeout: 3000,
      });

      hideOverlay();
      clearSelectedBoard();
    })
    .catch((error) => {
      console.log("error", error);
    });
};
</script>
