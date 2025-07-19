<script setup>
import { useForm } from "@inertiajs/vue3";
import SideNavigation from "@/Layouts/navigations/SideNavigation.vue";

const form = useForm({
    category_name: null,
});

const submit = () => {
    form.post(route("category.store"), {
        onSuccess: () => {
            form.reset("category_name");
            console.log("Category Created");
        },
    });

    console.log(form.category_name);
};
</script>

<template>
    <Head title="Category"></Head>
    <SideNavigation />
    <v-form @submit.prevent="submit">
        <v-card width="500">
            <v-card-text>
                <v-row>
                    <v-col cols="12">
                        <v-text-field
                            label="Enter Category"
                            v-model="form.category_name"
                        >
                        </v-text-field>
                    </v-col>
                </v-row>
                <v-btn
                    block
                    type="submit"
                    color="teal-darken-4"
                    :loading="form.processing"
                >
                    Submit</v-btn
                >
            </v-card-text>
        </v-card>
    </v-form>
</template>
