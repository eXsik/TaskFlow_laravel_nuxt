const isVisibleOverlay = ref(false);

export const useOverlayState = () => {
  const showOverlay = () => (isVisibleOverlay.value = true);
  const hideOverlay = () => (isVisibleOverlay.value = false);

  return { isVisibleOverlay, showOverlay, hideOverlay };
};
