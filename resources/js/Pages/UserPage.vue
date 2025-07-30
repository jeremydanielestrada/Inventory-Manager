<script setup>
import SideNavigation from "@/Layouts/navigations/SideNavigation.vue";
import PaginationLinks from "@/Components/PaginationLinks.vue";

defineProps({
    user: Object,
    products: Object,
});
</script>

<template>
    <Head :title="`${user.firstName}'s Products `" />
    <SideNavigation />

    <v-row>
        <v-col cols="4" sm="6" lg="3">
            <h3>{{ user.firstName }}'s product list</h3>
        </v-col>

        <v-col cols="12" sm="6" lg="12" md="12">
            <div v-if="products.data.length">
                <v-table hover>
                    <thead>
                        <tr class="bg-teal-lighten-4">
                            <th class="text-left">Product Name</th>
                            <th class="text-left">Date Added by user</th>
                            <th class="text-left">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products.data" :key="product.id">
                            <td>
                                {{ product.product_name }}
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
