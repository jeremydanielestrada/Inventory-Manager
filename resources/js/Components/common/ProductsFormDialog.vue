<script setup>
import { useDisplay } from "vuetify";
import { useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import { fileExtract } from "@/utils/helpers";

const props = defineProps(["isDialogVisible", "productData", "categories"]);
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
    category: null,
    category_id: null,
});

const selectCategory = props.categories;

const isUpdate = ref(false);

const imgPreview = ref("/storage/product/default_product.png");

// watch(
//     () => props.productData,
//     (newProduct) => {
//         isUpdate.value = !!newProduct;
//         if (isUpdate.value) {
//             formData.product_name = newProduct.product_name ?? null;
//             formData.image_path = newProduct.image_path ?? null;
//             formData.description = newProduct.description ?? null;
//             formData.quantity = newProduct.quantity ?? null;
//             formData.price = newProduct.price ?? null;
//             categoryForm.category_name = newProduct ?? null;
//             imgPreview.value = newProduct.image_path
//                 ? `/storage/${newProduct.image_path}`
//                 : "/storage/product/default_product.png";
//         } else {
//             // Reset form for adding new product
//             formData.product_name = null;
//             formData.image_path = null;
//             formData.description = null;
//             formData.quantity = null;
//             formData.price = null;
//             categoryForm.category_name = null;
//             imgPreview.value = "/storage/product/default_product.png";
//         }
//     },
//     { immediate: true }
// );

const onPreview = async (event) => {
    const { fileObject, fileUrl } = await fileExtract(event);
    // Update formData
    formData.image_path = fileObject;
    // Update imgPreview state
    imgPreview.value = fileUrl;
};

// Function to reset preview if file-input clear is clicked
const onPreviewReset = () => {
    formData.image_path = null; // Clear the uploaded file
    imgPreview.value = "/storage/product/default_product.png";
};

const onSubmit = () => {
    formData.post(route("products.store"), {
        forceFormData: true,
        onSuccess: () => {
            emit("update:isDialogVisible", false);
            formData.reset();
        },
        onError: () => {
            console.log("Error Submitting Products");
        },
    });
};
</script>

<template>
    <v-dialog
        :width="mobile ? ' 300' : '800'"
        v-model="props.isDialogVisible"
        persistent
        temporary
    >
        <v-form @submit.prevent="onSubmit">
            <v-card>
                <v-card-text>
                    <v-row>
                        <v-col cols="12">
                            <v-text-field
                                label="Product Name"
                                type="text"
                                v-model="formData.product_name"
                            />
                            <small v-if="formData.errors.product_name">
                                {{ formData.errors.product_name }}</small
                            >
                        </v-col>
                        <v-col cols="12">
                            <v-select
                                label="Select Category"
                                :items="selectCategory"
                                v-model="formData.category_id"
                                density="compact"
                                item-title="category_name"
                                item-value="id"
                                chips
                                clearable
                            >
                            </v-select>

                            <small v-if="formData.errors.category_id">
                                {{ formData.errors.category_id }}</small
                            >
                        </v-col>

                        <v-col cols="12" sm="6">
                            <v-text-field
                                label="Quantity"
                                type="number"
                                v-model="formData.quantity"
                                :error-messages="formData.errors.quantity"
                            />

                            <small v-if="formData.errors.quantity">
                                {{ formData.errors.quantity }}</small
                            >
                        </v-col>

                        <v-col cols="12" sm="6">
                            <v-text-field
                                label="Price"
                                type="number"
                                v-model="formData.price"
                            />

                            <small v-if="formData.errors.pricety">
                                {{ formData.errors.price }}</small
                            >
                        </v-col>

                        <v-col cols="12">
                            <v-textarea
                                v-model="formData.description"
                                label="Description"
                                rows="2"
                            ></v-textarea>

                            <small v-if="formData.errors.description">
                                {{ formData.errors.descriptionce }}</small
                            >
                        </v-col>

                        <v-col cols="12" sm="6" md="4">
                            <v-img
                                width="55%"
                                class="mx-auto rounded-circle"
                                color="teal-darken-2"
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

                            <small v-if="formData.errors.image">
                                {{ formData.errors.image }}</small
                            >
                        </v-col>
                        <v-btn type="submit" color="teal-darken-2" block>
                            submit
                        </v-btn>
                    </v-row>
                </v-card-text>
                <v-card-actions>
                    <v-btn
                        @click="emit('update:isDialogVisible', false)"
                        :loading="formData.processing"
                        >Close dialog</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-form>
    </v-dialog>
</template>
