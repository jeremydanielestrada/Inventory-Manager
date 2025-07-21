<script setup>
import SideNavigation from "@/Layouts/navigations/SideNavigation.vue";
import { getMoneyText } from "@/utils/helpers";
import { useTheme } from "vuetify";
import { useDisplay } from "vuetify";
import { ref } from "vue";
defineProps({
    product: Object,
});

const theme = useTheme();

const currentTheme = ref(theme.global.name.value);
</script>

<template>
    <Head title="Product Detail" />
    <SideNavigation></SideNavigation>

    <v-row>
        <v-col cols="12">
            <v-card
                variant="outlined"
                :color="
                    currentTheme === 'light'
                        ? 'teal-darken-2'
                        : 'teal-lighten-2'
                "
                width="800"
            >
                <v-card-title>{{
                    product.category?.category_name || "No Category"
                }}</v-card-title>
                <v-card-text>
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

                    <div class="d-flex align-center ga-5">
                        <div class="d-flex flex-column ga-2 mt-3">
                            <p class="text-body-1">
                                {{ product.product_name }}
                            </p>
                            <p class="text-body-1">
                                {{ getMoneyText(product.price) }}
                            </p>

                            <p class="text-disabled">
                                {{ product.quantity }}
                            </p>
                        </div>

                        <p class="font-weight-medium text-left">
                            {{ product.description }}
                        </p>
                    </div>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-btn>Delete</v-btn>
                    <v-btn>Update</v-btn>
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</template>
