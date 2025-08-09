<script setup>
import SideNavigation from "@/Layouts/navigations/SideNavigation.vue";
import { getMoneyText } from "@/utils/helpers";
import { useTheme } from "vuetify";
import { useDisplay } from "vuetify";
import { ref } from "vue";
import ProductsFormDialog from "@/Components/common/ProductsFormDialog.vue";
import { router } from "@inertiajs/vue3";
import ConfirmDialog from "@/Components/common/ConfirmDialog.vue";

const props = defineProps({
    product: Object,
    categories: Array,
    canModify: Boolean,
});

const theme = useTheme();

const { mobile } = useDisplay();

const isDialogVisible = ref(false);

const isConfirmDialogVisible = ref(false);

const onDelete = () => {
    router.delete(route("products.delete", props.product.id));
};

const backOne = () => window.history.back();
</script>

<template>
    <Head title="Product Detail" />
    <SideNavigation></SideNavigation>

    <v-icon size="30" @click="backOne">mdi-keyboard-backspace</v-icon>

    <v-card :width="!mobile ? 800 : 350" class="mx-auto">
        <v-card-title>
            <v-chip>
                {{ product.category?.category_name || "No Category" }}</v-chip
            >
        </v-card-title>
        <v-card-text>
            <v-row>
                <v-col cols="12" sm="6">
                    <v-img
                        :src="
                            product.image_path
                                ? `/storage/${product.image_path}`
                                : '/storage/product/default_product.png'
                        "
                        height="200"
                        cover
                    >
                    </v-img>
                </v-col>
                <v-col cols="12" sm="6">
                    <div class="d-flex align-center ga-2 justify-space-around">
                        <p class="text-subtitle-1 font-weight-bold">
                            {{ product.product_name }}
                        </p>
                        <p class="text-body-1 f-weight">
                            {{ getMoneyText(product.price) }}
                        </p>

                        <p class="text-disabled">
                            Quantity: {{ product.quantity }}
                        </p>
                    </div>
                    <v-divider></v-divider>
                    <p class="font-weight-medium text-left mt-2">
                        {{ product.description }}
                    </p>
                </v-col>
            </v-row>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
            <div
                v-if="props.canModify || $page.props.auth.user.role === 'admin'"
            >
                <v-btn @click="isConfirmDialogVisible = !isConfirmDialogVisible"
                    >Delete</v-btn
                >
                <v-btn @click="isDialogVisible = !isDialogVisible"
                    >Update</v-btn
                >
            </div>
            <div v-else>
                <p class="text-disabled text-right">View Only</p>
            </div>
        </v-card-actions>
    </v-card>

    <ProductsFormDialog
        v-model:isDialogVisible="isDialogVisible"
        :productData="product"
        :categories="categories"
    ></ProductsFormDialog>
    <ConfirmDialog
        v-model:isDialogVisible="isConfirmDialogVisible"
        title="Delete Product"
        text="Please Confirm to delte this item"
        @confirm="onDelete"
    ></ConfirmDialog>
</template>

<style scoped>
.f-weight {
    font-weight: 600;
}
</style>
