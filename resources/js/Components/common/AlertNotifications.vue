<script setup>
import { useDisplay } from "vuetify";
import { ref } from "vue";
const { mobile } = useDisplay();
defineProps({
    status: String,
});
</script>

<template>
    <v-alert
        :width="mobile ? 300 : 500"
        closable
        type="success"
        :text="status"
        class="mx-auto"
        v-if="status"
    ></v-alert>
</template>
