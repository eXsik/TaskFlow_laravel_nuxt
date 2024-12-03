import type { Card } from "~/types";

export const useCardState = () => {
  const selectedCard = useState<Card | null>("selectedCard", () => null);

  const selectCard = (card: Card) => {
    selectedCard.value = card;
  };

  const clearSelectedCard = () => {
    selectedCard.value = null;
  };

  return {
    selectedCard,
    selectCard,
    clearSelectedCard,
  };
};
