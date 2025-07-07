<script setup>
import { ref } from "vue";

const theme = ref(localStorage.getItem("theme") ?? "light");

const onThemeUpdate = (value) => {
    theme.value = value;
};
</script>

<template>
    <Head title="Home"></Head>
</template>
