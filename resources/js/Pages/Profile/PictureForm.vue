<script setup>
import { ref, watch, onMounted } from "vue";
import { fileExtract } from "@/utils/helpers";
import { useForm } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";

//Load Variables

const { auth } = usePage().props;

const formData = useForm({
    image: null,
});

const imagePreview = ref("storage/avatar/default-avatar.png");

// Initialize image preview on component mount
onMounted(() => {
    if (auth.user?.image) {
        imagePreview.value = `/storage/${auth.user.image}`;
    }
});

watch(
    () => auth.user?.image,
    (newImage) => {
        if (newImage) {
            imagePreview.value = `/storage/${newImage}`;
        } else {
            imagePreview.value = "storage/avatar/default-avatar.png";
        }
    }
);

const onPreview = async (event) => {
    const { fileObject, fileUrl } = await fileExtract(event);
    // Update formData
    formData.image = fileObject;
    // Update imgPreview state
    imagePreview.value = fileUrl;
};

// Function to reset preview if file-input clear is clicked
const onPreviewReset = () => {
    formData.image = null; // Clear the uploaded file
    imagePreview.value = auth.user.image
        ? `/storage/${auth.user.image}`
        : "/storage/avatar/default-avatar.png";
};

const onSubmit = () => {
    formData.post(route("profile.image"), {
        forceFormData: true,
        onSuccess: () => {
            formData.reset();
        },
        onError: (errors) => {
            console.log("Upload errors:", errors);
        },
    });
};
</script>

<template>
    <v-form @submit.prevent="onSubmit">
        <v-row>
            <v-col cols="12" md="5" sm="6">
                <v-img
                    width="55%"
                    class="mx-auto rounded-circle"
                    aspect-ratio="1"
                    color="blue-darken-4"
                    :src="imagePreview"
                    alt="Profile Picture Preview"
                    cover
                >
                </v-img>
            </v-col>

            <v-col cols="12" md="6" sm="7">
                <v-file-input
                    class="mt-5"
                    accept="image/png, image/jpeg, image/bmp"
                    label="Browse Profile Picture"
                    placeholder="Browse Profile Picture"
                    prepend-icon="mdi-camera"
                    show-size
                    chips
                    @change="onPreview"
                    @click:clear="onPreviewReset"
                    :error-messages="formData.errors.image"
                >
                </v-file-input>

                <v-btn
                    class="mt-2"
                    type="submit"
                    color="teal-darken-4"
                    prepend-icon="mdi-image-edit"
                    :disabled="formData.processing"
                    :loading="formData.processing"
                >
                    Update Picture
                </v-btn>
            </v-col>
        </v-row>
    </v-form>
</template>
