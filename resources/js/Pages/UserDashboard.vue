<script setup>
import SideNavigation from "@/Layouts/navigations/SideNavigation.vue";
import ConfirmDialog from "@/Components/common/ConfirmDialog.vue";
import PaginationLinks from "@/Components/PaginationLinks.vue";
import AlertNotifications from "@/Components/common/AlertNotifications.vue";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    products: Object,
    categories: Object,
    status: String,
});

const isDialogVisible = ref(false);

console.log(props.categories);
</script>

<template>
    <Head title="Dasboard" />
    <SideNavigation />
    <AlertNotifications :status="status" />

    <v-row>
        <v-col cols="12" sm="4" lg="12">
            <h3>Your Products</h3>
        </v-col>
        <v-col
            cols="12"
            sm="4"
            lg="3"
            v-for="category in categories"
            :key="category.id"
        >
            <p
                v-if="
                    category.products_count < 5 && category.products_count != 0
                "
            >
                Your {{ category.category_name }} has a low stock
                <v-icon color="warning">mdi-circle</v-icon>
            </p>
        </v-col>

        <v-col cols="12">
            <div v-if="products.data.length">
                <v-table hover>
                    <thead>
                        <tr class="bg-teal-lighten-4">
                            <th class="text-left">Product name</th>
                            <th class="text-left">Image</th>
                            <th class="text-left">Date Added</th>
                            <th>View</th>
                            <th>Delete</th>
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
                            <td>
                                <Link
                                    :href="route('products.show', product.id)"
                                    class="text-decoration-none text-teal-lighten-3"
                                >
                                    <v-icon>mdi-eye-arrow-right</v-icon>
                                </Link>
                            </td>
                            <td>
                                <v-icon
                                    color="error"
                                    @click="isDialogVisible = !isDialogVisible"
                                    >mdi-trash-can</v-icon
                                >
                            </td>
                            <ConfirmDialog
                                title="Delete Product"
                                text="Are you sure you want to delete this on your lisitngs?"
                                v-model:isDialogVisible="isDialogVisible"
                                @confirm="
                                    () => {
                                        router.delete(
                                            route('products.delete', product.id)
                                        );
                                    }
                                "
                            />
                        </tr>
                    </tbody>
                </v-table>
            </div>

            <div class="text-center" v-else>
                You dont have any products, go to products to add
            </div>
        </v-col>
    </v-row>

    <!-- Pagination -->
    <PaginationLinks
        :paginator="products"
        v-if="Object.keys(products.data).length > 0"
    />
</template>

<style scoped>
.img-style {
    border-radius: 100px;
}
</style>
