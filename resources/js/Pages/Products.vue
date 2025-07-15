<script setup>
import { ref } from "vue";
import SideNavigation from "@/Layouts/navigations/SideNavigation.vue";
import ProductCard from "@/Components/ProductCard.vue";
import PaginationLinks from "@/Components/PaginationLinks.vue";
import { useForm, router } from "@inertiajs/vue3";

const props = defineProps({
    products: Object,
    searchTerm: String,
});

const form = useForm({
    search: props.searchTerm,
});

const search = () => {
    router.get(route("products"), { search: form.search });
};

//Back to products page if there is no existing item
const returnHome = () => {
    router.get(route("products"));
};
</script>

<template>
    <Head title="Products"></Head>
    <SideNavigation></SideNavigation>
    <!-- for checking the link -->
    {{ console.log(products.data) }}
    <v-row class="d-flex align-center justify-space-between">
        <v-col cols="12" sm="6" md="12" lg="6"> category </v-col>

        <v-col cols="12" sm="6" md="12" lg="3">
            <v-form @submit.prevent="search">
                <v-text-field
                    type="search"
                    v-model="form.search"
                    label="Search Product"
                    variant="outlined"
                    density="compact"
                    append-inner-icon="mdi-magnify"
                    clearable
                ></v-text-field>
            </v-form>
        </v-col>
    </v-row>

    <div
        v-if="products.data.length <= 0"
        class="d-flex flex-column align-center"
    >
        <h3 class="text-center">There is no existing product</h3>

        <v-btn
            @click="returnHome"
            size="x-small"
            variant="outlined"
            color="teal-darken-2"
        >
            return to home
            <v-icon> mdi-keyboard-return </v-icon>
        </v-btn>
    </div>

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

    <!-- Pagination -->
    <PaginationLinks :paginator="products" />
</template>
