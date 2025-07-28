<script setup>
import { getMoneyText } from "@/utils/helpers";

defineProps({
    product: Object,
});
</script>

<template>
    <v-card height="100%" class="d-flex flex-column ga-2" v-if="product">
        <v-card-text>
            <!-- img -->

            <Link :href="route('products.show', product.id)">
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
            </Link>

            <h3 class="font-weight-bold">
                {{ product.product_name }}
            </h3>
            <p class="font-weight-medium">
                {{ product.description.substring("0", 40) }}...
            </p>

            <v-divider></v-divider>
            <div class="d-flex align-center justify-space-between pt-2">
                <h5 variant="plain" disabled class="font-weight-black">
                    {{ product.category?.category_name || "No Category" }}
                </h5>
                <p class="font-weight-light">
                    Added on
                    {{
                        new Date(product.created_at)
                            .toLocaleDateString("en-US", {
                                month: "long",
                                day: "2-digit",
                                year: "numeric",
                            })
                            .replace(/g,/g, "/")
                    }}
                </p>
            </div>
        </v-card-text>
    </v-card>
</template>
