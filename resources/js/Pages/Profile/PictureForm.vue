<script setup>
import { ref, watch } from "vue";
import { fileExtract } from "@/utils/helpers";
import { useForm } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";

//Load Variables

const { auth } = usePage().props;

const formData = useForm({
    image: null,
    _method: PUT,
});

const imagePreview = ref("storage/avatar/default-avatar.png");

watch(
    () => auth.user?.image,
    (newImage) => {
        if (newImage) {
            imagePreview.value = `/storage/${formData.image}`;
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
            onPreviewReset();
        },
    });
};
</script>
