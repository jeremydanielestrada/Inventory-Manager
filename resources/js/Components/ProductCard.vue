<script setup>
import { getMoneyText } from "@/utils/helpers";
defineProps({
    product: Object,
});
</script>

<template>
    <v-card height="100%" class="d-flex flex-column ga-2">
        <v-card-text>
            <!-- img -->

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

            <h3 class="font-weight-bold">
                {{ product.product_name }}
            </h3>
            <p class="font-weight-medium">
                {{ product.description.substring("0", 40) }}...
            </p>
            <p>{{ product.quantity }}</p>
            <p class="font-weight-bold">{{ getMoneyText(product.price) }}</p>
        </v-card-text>
        <v-card-actions class="d-flex align-center justify-space-between">
            <v-btn variant="plain" disabled class="font-weight-black">{{
                product.category?.category_name || "No Category"
            }}</v-btn>
            <p class="font-weight-light">
                Added on {{ new Date(product.created_at).toLocaleDateString() }}
            </p>
        </v-card-actions>
    </v-card>
</template>
