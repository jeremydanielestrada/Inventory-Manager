<script setup>
import SideNavigation from "@/Layouts/navigations/SideNavigation.vue";

const props = defineProps({
    user: Object,
});

console.log(props.user);
</script>

<template>
    <Head title="Profile" />
    <SideNavigation />
    <h1>Profile</h1>
</template>
