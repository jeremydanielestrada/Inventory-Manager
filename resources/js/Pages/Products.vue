<script setup>
import { ref } from "vue";
import SideNavigation from "@/Layouts/navigations/SideNavigation.vue";
import ProductCard from "@/Components/ProductCard.vue";

defineProps({
    products: Object,
});
</script>

<template>
    <Head title="Products"></Head>
    <SideNavigation></SideNavigation>

    <v-row v-if="Object.keys(products.data).length">
        <v-col
            v-for="product in products.data"
            :key="product.id"
            cols="12"
            sm="6"
            md="8"
            lg="5"
            xl="3"
        >
            <ProductCard :product="product" />
        </v-col>
    </v-row>
</template>
