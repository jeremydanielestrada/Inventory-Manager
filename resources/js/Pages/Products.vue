<script setup>
import { ref } from "vue";
import SideNavigation from "@/Layouts/navigations/SideNavigation.vue";
import ProductCard from "@/Components/ProductCard.vue";
import PaginationLinks from "@/Components/PaginationLinks.vue";
import { useForm, router } from "@inertiajs/vue3";
import ProductsFormDialog from "@/Components/common/ProductsFormDialog.vue";

const props = defineProps({
    products: Object,
    searchTerm: String,
    categories: Array,
});

function filterByCategory(categoryId) {
    router.get(
        route("products"),
        { category: categoryId },
        { preserveState: true, preserveScroll: true }
    );
}

const isDialogVisible = ref(false);

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

const refreshFilter = () => {
    router.get(route("products", { search: null, category: null }));
};
</script>

<template>
    <Head title="Products"></Head>
    <SideNavigation></SideNavigation>

    <v-row class="d-flex align-center justify-space-between">
        <v-col cols="12" sm="4" md="4" lg="3" class="d-flex ga-2 align-center">
            <v-select
                :items="categories"
                item-title="category_name"
                item-value="id"
                label="Select Category"
                clearable
                @update:modelValue="filterByCategory"
                variant="solo-filled"
                density="compact"
                chips
            ></v-select>

            <v-btn icon size="30" class="mb-5" @click="refreshFilter">
                <v-icon>mdi-refresh</v-icon>
            </v-btn>

            <v-btn
                icon
                size="30"
                class="mb-5"
                @click="isDialogVisible = !isDialogVisible"
            >
                <v-icon>mdi-plus</v-icon>
            </v-btn>
        </v-col>

        <v-col cols="12" sm="6" md="6" lg="3">
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
    <PaginationLinks
        :paginator="products"
        v-if="Object.keys(products.data).length > 0"
    />
    <ProductsFormDialog
        v-model:isDialogVisible="isDialogVisible"
        :categories="categories"
    />
</template>
