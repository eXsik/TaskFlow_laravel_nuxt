<template>
  <UForm
    :state="form"
    :schema="CardSchema"
    class="space-y-4 px-4 py-2"
    @submit.prevent="submit"
  >
    <UFormGroup name="name" label="Name">
      <UInput v-model="form.name" />
    </UFormGroup>

    <UButton type="submit" block :loading="form.processing">
      {{ type === "update" ? "Update" : "Create" }}
    </UButton>
  </UForm>
</template>

<script setup lang="ts">
import { useCardState } from "~/composable/useCardState";
import { useOverlayState } from "~/composable/useOverlayState";
import CardSchema from "~/schemas/Card.schema";
import type { Card } from "~/types";

interface CardFormProps {
  type: "create" | "update";
  initialData: Card | null;
  boardId: string;
  onCreate?: () => void;
  onUpdate?: () => void;
}

const emit = defineEmits<{
  (e: "createCard"): void;
}>();

const props = defineProps<CardFormProps>();
const { hideOverlay } = useOverlayState();
const { clearSelectedCard } = useCardState();

const form = useSanctumForm(
  props.type === "update" ? "put" : "post",
  props.type === "update"
    ? `/api/cards/${props.initialData?.id}`
    : `/api/cards`,
  {
    name: props.initialData?.name || "",
    board_id: props.boardId,
  }
);

const submit = async () => {
  form
    .submit()
    .then(async (response) => {
      emit("createCard");
      form.reset();

      useToast().add({
        icon: "i-heroicons-check-circle",
        title: `Card ${props.type === "update" ? "updated" : "created"}!`,
        description: `Your card has been ${
          props.type === "update" ? "updated" : "created"
        } successfully!`,
        timeout: 3000,
      });

      hideOverlay();
      clearSelectedCard();
    })
    .catch((error) => {
      console.log("error", error);
    });
};
</script>
