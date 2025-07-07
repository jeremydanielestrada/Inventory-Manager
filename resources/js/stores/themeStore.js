import { defineStore } from "pinia";

export const useThemeStore = defineStore("themeStore", () => {
    const mode = ref("light");

    function setMode(newMode) {
        mode.value = newMode;
    }

    return {
        mode,
        setMode,
    };
});
