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
    >
        <v-list>
            <v-list-item title="Navigation drawer"></v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>
