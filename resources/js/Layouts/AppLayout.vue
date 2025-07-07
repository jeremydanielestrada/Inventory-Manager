<script setup>
import { ref } from "vue";

const theme = ref("light");

function onClick() {
    theme.value = theme.value === "light" ? "dark" : "light";
    localStorage.setItem("theme", theme.value);
}
</script>

<template>
    <v-responsive class="border rounded">
        <v-app :theme="theme">
            <v-app-bar
                class="px-3"
                border
                :color="theme === 'light' ? 'teal-lighten-2' : 'teal-darken-2'"
            >
                <v-spacer></v-spacer>

                <v-btn
                    :prepend-icon="
                        theme === 'light'
                            ? 'mdi-weather-sunny'
                            : 'mdi-weather-night'
                    "
                    slim
                    @click="onClick"
                ></v-btn>
            </v-app-bar>

            <v-main>
                <v-container>
                    <slot />
                </v-container>
            </v-main>
        </v-app>
    </v-responsive>
</template>
