<script setup>
import { ref, provide, watch } from "vue";
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
const isDrawerVisible = ref(localStorage.getItem("drawer") === "true"); // restore state

function toggleDrawer() {
    isDrawerVisible.value = !isDrawerVisible.value;
}

watch(isDrawerVisible, (val) => {
    localStorage.setItem("drawer", val);
});

//Provide values
provide("isDrawerVisible", isDrawerVisible);
provide("toggleDrawer", toggleDrawer);

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
                <v-app-bar-nav-icon
                    icon="mdi-menu"
                    :theme="currentTheme"
                    @click="toggleDrawer"
                    v-if="$page.props.auth.user"
                >
                </v-app-bar-nav-icon>

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
            <slot name="navigation"></slot>

            <v-main>
                <v-container>
                    <slot />
                </v-container>
            </v-main>
        </v-app>
    </v-responsive>
</template>
