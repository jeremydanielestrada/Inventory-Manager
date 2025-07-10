<script setup>
import { ref } from "vue";
import SideNavigation from "@/Layouts/navigations/SideNavigation.vue";
</script>

<template>
    <Head title="Dashboard"></Head>
    <SideNavigation></SideNavigation>

    <h1 v-if="$page.props.auth.user?.firstName">
        Welcome to dashboard {{ $page.props.auth.user.firstName }}
    </h1>
</template>
