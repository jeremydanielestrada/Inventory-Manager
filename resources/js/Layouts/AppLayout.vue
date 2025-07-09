<script setup>
import { ref } from "vue";
import { useTheme } from "vuetify";
import { router } from "@inertiajs/vue3";
const theme = useTheme();
const currentTheme = ref(theme.global.name.value);

function onToggleTheme() {
    const newTheme = currentTheme.value === "light" ? "dark" : "light";
    theme.global.name.value = newTheme;
    currentTheme.value = newTheme;
    localStorage.setItem("theme", newTheme);
}

const logout = () => {
    router.post("/logout");
};
</script>

<template>
    <v-responsive class="border rounded">
        <v-app :theme="currentTheme">
            <v-app-bar
                class="px-3"
                border
                :color="
                    currentTheme === 'light'
                        ? 'teal-lighten-2'
                        : 'teal-darken-2'
                "
            >
                <v-spacer></v-spacer>

                <v-btn
                    :prepend-icon="
                        currentTheme === 'light'
                            ? 'mdi-weather-sunny'
                            : 'mdi-weather-night'
                    "
                    slim
                    @click="onToggleTheme"
                ></v-btn>

                <v-btn v-if="$page.props.auth.user" @click="logout">
                    Log out
                    <v-icon>mdi-logout</v-icon>
                </v-btn>
            </v-app-bar>

            <v-main>
                <v-container>
                    <slot />
                </v-container>
            </v-main>
        </v-app>
    </v-responsive>
</template>
