<script setup>
import { useDisplay } from "vuetify";
import { useForm } from "@inertiajs/vue3";
import ProductTextInput from "../ProductTextInput.vue";
import { ref, watch } from "vue";

const props = defineProps(["isDialogVisible", "productData"]);
const emit = defineEmits(["update:isDialogVisible"]);

//Load pre defined functions
const { mobile } = useDisplay();

//Load variables
const formData = useForm({
    product_name: null,
    image_path: null,
    description: null,
    quantity: null,
    price: null,
});

const categoryForm = useForm({
    category_name: null,
});

const selectCategory = ["Category 1", "Category 2", "Category 3"];

const isUpdate = ref(false);

const imgPreview = ref("/storage/product/default_product.png");

watch(
    () => props.productData,
    () => {
        isUpdate.value = props.itemData ? true : false;
    }
);
</script>
<template>
    <v-dialog :width="mobile ? ' 300' : '800'" v-model="props.isDialogVisible">
        <v-form>
            <v-card>
                <v-card-text>
                    <v-row>
                        <ProductTextInput
                            name="Product Name"
                            :type="text"
                            v-model="formData.product_name"
                        />

                        <v-col cols="12">
                            <v-select
                                label="Select Category"
                                :item="selectCategory"
                                v-model="categoryForm.category_name"
                                variant="outlined"
                                density="compact"
                                chips
                                clearable
                            >
                            </v-select>
                        </v-col>

                        <ProductsFormDialog
                            name="Quantity"
                            :type="number"
                            v-model="formData.quantity"
                        />
                        <ProductsFormDialog
                            name="Price"
                            :type="number"
                            v-model="formData.price"
                        />
                        <v-cols cols="12">
                            <v-textarea
                                v-model="formData.description"
                                label="Description"
                                rows="2"
                            ></v-textarea>
                        </v-cols>

                        <v-col cols="12" sm="6" md="4">
                            <v-img
                                width="55%"
                                class="mx-auto rounded-circle"
                                color="red-darken-4"
                                aspect-ratio="1"
                                :src="imgPreview"
                                alt="Item Picture Preview"
                                cover
                            >
                            </v-img>
                        </v-col>

                        <v-col cols="12" sm="6" md="8">
                            <v-file-input
                                class="mt-5"
                                accept="image/png, image/jpeg"
                                label="Browse Item Picture"
                                placeholder="Browse Item Picture"
                                prepend-icon="mdi-camera"
                                show-size
                                chips
                                @change="onPreview"
                                @click:clear="onPreviewReset"
                            ></v-file-input>
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-card-actions>
                    <v-btn @click="emit('update:isDialogVisible', false)"
                        >Close dialog</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-form>
    </v-dialog>
</template>
