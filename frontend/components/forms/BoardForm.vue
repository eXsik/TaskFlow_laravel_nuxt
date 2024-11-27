<template>
  <UForm
    :state="formState"
    :schema="BoardSchema"
    class="space-y-4 px-4 py-2"
    @submit.prevent="handleBoardForm"
  >
    <UFormGroup name="name" label="Name">
      <UInput v-model="formState.name" />
    </UFormGroup>
    <UFormGroup name="description" label="Description">
      <UInput v-model="formState.description" />
    </UFormGroup>

    <UButton type="submit" block :loading="isLoading">
      <template v-if="type === 'create'"> Create </template>
      <template v-else> Update </template>
    </UButton>
  </UForm>
</template>

<script setup lang="ts">
import { useOverlayState } from "~/composable/useOverlayState";
import BoardSchema from "~/schemas/Board.schema";
import type { Board } from "~/types";

interface BoardFormProps {
  type: "create" | "update";
  initialData?: Board;
  onCreate?: () => void;
  onUpdate?: () => void;
}

const emit = defineEmits<{
  (e: "createBoard"): void;
}>();

const props = withDefaults(defineProps<BoardFormProps>(), {
  type: "create",
});
const { hideOverlay } = useOverlayState();
const isLoading = ref(false);

const formState = reactive<Partial<Board>>({
  name: "",
  image: "",
  description: "",
});

watchEffect(() => {
  if (props.type === "update" && props.initialData) {
    formState.name = props.initialData.name || "";
    formState.description = props.initialData.description || "";
    formState.image = props.initialData.image || "";
  }
});

const handleBoardForm = async () => {
  isLoading.value = true;

  try {
    useSanctumForm("post", `/api/boards`, {
      formState,
    });

    emit("createBoard");
    useToast().add({
      icon: "i-octicon-check-circle",
      title: "Board Created!",
      description: "Your board has been created successfully!",
      timeout: 3000,
    });
    hideOverlay();
  } catch (error) {
    console.log("error", error);
  } finally {
    isLoading.value = false;
  }
};
</script>
