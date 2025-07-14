<script setup>
import { ref } from "vue";
import SideNavigation from "@/Layouts/navigations/SideNavigation.vue";
import ProductCard from "@/Components/ProductCard.vue";
import PaginationLinks from "@/Components/PaginationLinks.vue";

defineProps({
    products: Object,
});
</script>

<template>
    <Head title="Products"></Head>
    <SideNavigation></SideNavigation>
    <!-- for checking the link -->
    {{ console.log(products.links) }}
    <v-row v-if="Object.keys(products.data).length">
        <v-col
            v-for="product in products.data"
            :key="product.id"
            cols="12"
            sm="6"
            md="4"
            lg="6"
            xl="3"
        >
            <ProductCard :product="product" />
        </v-col>
    </v-row>
    <PaginationLinks :paginator="products" />
</template>
