<script setup>
import { watch, inject, computed } from "vue";
import { useDisplay } from "vuetify";
import { router } from "@inertiajs/vue3";

//Inject variables value
const isDrawerVisible = inject("isDrawerVisible");
//Utilize pre-defined functions
const { mobile } = useDisplay();

// Computed properties to check active routes
const isCategoryActive = computed(() => route().current("categories"));
const isProductsActive = computed(() => route().current("products"));

///defining routes
//to category
const toCategory = () => router.get(route("categories"));

//to product
const toProducts = () => router.get(route("products"));
</script>

<template>
    <v-navigation-drawer
        v-model="isDrawerVisible"
        :persistent="mobile"
        :temporary="mobile"
        :permanent="!mobile"
        width="325"
        border
    >
        <v-list>
            <v-list-item
                prepend-icon="mdi-folder-plus-outline"
                title="Add new category"
                link
                @click="toCategory"
                :active="isCategoryActive"
                :color="isCategoryActive ? 'teal-darken-2' : ''"
                v-if="$page.props.auth.user.role === 'admin'"
            />

            <v-list-item
                prepend-icon="mdi-folder-plus-outline"
                title="Products"
                link
                @click="toProducts"
                :active="isProductsActive"
                :color="isProductsActive ? 'teal-darken-2' : ''"
            />
        </v-list>
    </v-navigation-drawer>
</template>

<style scoped>
.text-deco {
    text-decoration: none;
}
</style>
