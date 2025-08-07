<script setup>
import { useDisplay } from "vuetify";
import { useForm, router } from "@inertiajs/vue3";
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
    _method: null,
});

const selectCategory = ref([]);

const isUpdate = ref(false);

const imgPreview = ref("/storage/product/default_product.png");

//Check for categories
watch(
    () => props.categories,
    (newCategories) => {
        selectCategory.value = newCategories || [];
    },
    { immediate: true }
);

//Check for product data
watch(
    () => props.productData,
    (newProduct) => {
        isUpdate.value = !!newProduct;
        if (isUpdate.value && newProduct) {
            formData.product_name = newProduct.product_name || "";
            formData.description = newProduct.description || "";
            formData.quantity = newProduct.quantity || 0;
            formData.price = newProduct.price || 0;
            formData.category_id = newProduct.category_id || null;
            formData._method = "Put";

            // Don't set image_path in the form data, just update the preview
            imgPreview.value = newProduct.image_path
                ? `/storage/${newProduct.image_path}`
                : "/storage/product/default_product.png";
        } else {
            // Reset form for adding new product
            formData.reset();
            imgPreview.value = "/storage/product/default_product.png";
        }
    },
    { immediate: true }
);

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
    imgPreview.value =
        isUpdate.value && props.productData.image_path
            ? `/storage/${props.productData.image_path}`
            : "/storage/product/default_product.png";
};

const onSubmit = () => {
    if (isUpdate.value) {
        // For updates, use a FormData object directly
        // const updateData = new FormData();
        // updateData.append("_method", "PUT");
        // updateData.append("product_name", formData.product_name);
        // updateData.append("category_id", formData.category_id);
        // updateData.append("price", formData.price);
        // updateData.append("quantity", formData.quantity);
        // updateData.append("description", formData.description || "");
        // updateData.append("image_path", formData.image_path);

        // Only append image if it's a File object
        // if (formData.image_path instanceof File) {

        //     console.log("Appending image file:", formData.image_path);
        // }

        // Use Inertia's router directly with headers
        formData.post(
            route("products.update", props.productData.id),
            // updateData,
            {
                forceFormData: true,
                onSuccess: () => {
                    emit("update:isDialogVisible", false);
                    formData.reset();
                    window.location.reload(); // Force reload to see changes
                },
                onError: (errors) => {
                    console.log("Error Updating Products", errors);
                },
            }
        );
    } else {
        formData.post(route("products.store"), {
            forceFormData: true,
            onSuccess: () => {
                emit("update:isDialogVisible", false);
                formData.reset();
            },
            onError: (errors) => {
                console.log("Error Submitting Products", errors);
            },
        });
    }
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
                                :error-messages="formData.errors.product_name"
                            />
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
                                :error-messages="formData.errors.category_id"
                            >
                            </v-select>
                        </v-col>

                        <v-col cols="12" sm="6">
                            <v-text-field
                                label="Quantity"
                                type="number"
                                v-model="formData.quantity"
                                :error-messages="formData.errors.quantity"
                            />
                        </v-col>

                        <v-col cols="12" sm="6">
                            <v-text-field
                                label="Price"
                                type="number"
                                v-model="formData.price"
                                :error-messages="formData.errors.price"
                            />
                        </v-col>

                        <v-col cols="12">
                            <v-textarea
                                v-model="formData.description"
                                label="Description"
                                rows="2"
                                :error-messages="formData.errors.description"
                            ></v-textarea>
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
                                :error-messages="formData.errors.image_path"
                            ></v-file-input>
                        </v-col>
                        <v-btn
                            type="submit"
                            color="teal-darken-2"
                            block
                            :loading="formData.processing"
                        >
                            {{ isUpdate ? "Update" : "Submit" }}
                        </v-btn>
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
