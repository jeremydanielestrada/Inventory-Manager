<script setup>
import { watch, inject } from "vue";
import { useDisplay } from "vuetify";

//Inject variables value
const isDrawerVisible = inject("isDrawerVisible");
//Utilize pre-defined functions
const { mobile } = useDisplay();
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
            <Link :href="route('categories')" class="text-deco">
                <v-list-item
                    prepend-icon="mdi-folder-plus-outline"
                    title="Create Category"
                />
            </Link>

            <Link :href="route('products')" class="text-deco">
                <v-list-item
                    prepend-icon="mdi-folder-plus-outline"
                    title="Products"
                />
            </Link>
        </v-list>
    </v-navigation-drawer>
</template>

<style scoped>
.text-deco {
    text-decoration: none;
    color: #4db6ac;
}
</style>
