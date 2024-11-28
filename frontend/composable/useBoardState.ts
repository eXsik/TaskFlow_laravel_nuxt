import type { Board } from "~/types";

export const useBoardState = () => {
  const selectedBoard = useState<Board | null>("selectedBoard", () => null);

  const selectBoard = (board: Board) => {
    selectedBoard.value = board;
  };

  const clearSelectedBoard = () => {
    selectedBoard.value = null;
  };

  return {
    selectedBoard,
    selectBoard,
    clearSelectedBoard,
  };
};
