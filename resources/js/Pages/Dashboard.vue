<script setup>
import { ref } from "vue";
</script>

<template>
    <Head title="Dashboard"></Head>
    <h1>Welcome to dashboard {{ $page.props.auth.user.firstName }}</h1>
</template>
