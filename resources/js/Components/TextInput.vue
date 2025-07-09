<script setup>
import { defineEmits } from "vue";
const model = defineModel({
    type: null,
    required: true,
});

const emit = defineEmits(["append-click"]);

defineProps({
    name: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: "text",
    },
    message: {
        type: String,
    },
    prependIcon: {
        type: String,
    },
    appendIcon: {
        type: String,
    },
});
</script>

<template>
    <v-text-field
        :prepend-inner-icon="prependIcon"
        :append-inner-icon="appendIcon"
        v-model="model"
        :label="name"
        :type="type"
        @click:append-inner="emit('append-click')"
    ></v-text-field>
    <small v-if="message">{{ message }}</small>
</template>

<style scoped>
small {
    color: #d50000;
}
</style>
