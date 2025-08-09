<script setup>
import SideNavigation from "@/Layouts/navigations/SideNavigation.vue";
import PaginationLinks from "@/Components/PaginationLinks.vue";
import { useForm, router } from "@inertiajs/vue3";

const props = defineProps({
    user: Object,
    products: Object,
});

const params = route().params;

const form = useForm({
    search: params.search,
});

const search = () => {
    router.get(
        route("user.show", {
            user: props.user.id,
            search: form.search,
        })
    );
};

const refreshFilter = () => {
    router.get(
        route("user.show", {
            search: null,
            user: props.user.id,
        })
    );
};

const items = [
    {
        title: "Table",
        disabled: false,
        href: route("admin.index"),
    },

    {
        title: "Products",
        disabled: true,
    },
];
</script>

<template>
    <Head :title="`${user.firstName}'s Products `" />
    <SideNavigation />

    <span class="text-h6 font-weight-bold">
        <v-breadcrumbs :items="items">
            <template #prepend>
                <v-icon icon="mdi-account" size="small" class="me-1"></v-icon>
            </template>
        </v-breadcrumbs>
    </span>

    <v-row>
        <v-col cols="8" sm="6" md="4" lg="3">
            <h3 class="mb-3">{{ user.firstName }}'s product list</h3>

            <v-form @submit.prevent="search">
                <v-text-field
                    type="search"
                    v-model="form.search"
                    label="Search User"
                    variant="outlined"
                    density="compact"
                    append-inner-icon="mdi-magnify"
                    clearable
                ></v-text-field>
            </v-form>
        </v-col>
        <v-col cols="4" sm="6" md="8" lg="9" class="d-flex align-center">
            <v-btn icon size="30" @click="refreshFilter">
                <v-icon>mdi-refresh</v-icon>
            </v-btn>
        </v-col>

        <v-col cols="12" sm="6" lg="12" md="12">
            <div v-if="products.data.length">
                <v-table hover>
                    <thead>
                        <tr class="bg-teal-lighten-4">
                            <th class="text-left">Product Name</th>
                            <th class="text-left">Image</th>
                            <th class="text-left">Date Added by user</th>
                            <th class="text-left">Quantity</th>
                            <th class="text-left">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products.data" :key="product.id">
                            <td>
                                {{ product.product_name }}
                            </td>
                            <td>
                                <v-avatar>
                                    <v-img
                                        :src="
                                            product.image_path
                                                ? `/storage/${product.image_path}`
                                                : '/storage/product/default_product.png'
                                        "
                                        cover
                                    >
                                    </v-img>
                                </v-avatar>
                            </td>
                            <td>
                                {{
                                    new Date(product.created_at)
                                        .toLocaleDateString("en-US", {
                                            month: "long",
                                            day: "2-digit",
                                            year: "numeric",
                                        })
                                        .replace(/g,/g, "/")
                                }}
                            </td>
                            <td>{{ product.quantity }}</td>
                            <td>
                                <Link
                                    :href="route('products.show', product.id)"
                                    class="text-decoration-none text-teal-lighten-3"
                                >
                                    <v-icon>mdi-eye-arrow-right</v-icon>
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </v-table>
            </div>

            <div class="text-center" v-else>
                {{ user.firstName }} dont have any products, go to products to
                add
            </div>
        </v-col>
    </v-row>

    <!-- Pagination -->
    <PaginationLinks
        :paginator="products"
        v-if="Object.keys(products.data).length > 0"
    />
</template>
