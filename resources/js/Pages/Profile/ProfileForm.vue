<script setup>
import { useForm, usePage } from "@inertiajs/vue3";

const { auth } = usePage().props;

//Load Variables
const formData = useForm({
    firstName: auth.user.firstName,
    lastName: auth.user.lastName,
    email: auth.user.email,
    _method: "PUT",
});

const onSubmit = () => {
    formData.post(route("profile.update"), {
        onSuccess: () => {
            formData.reset();
        },
        onError: () => console.log("Error Updating info"),
    });
};
</script>

<template>
    <v-form ref="refVForm" @submit.prevent="onSubmit">
        <v-row dense>
            <v-col cols="12" sm="4">
                <v-text-field
                    v-model="formData.firstName"
                    label="Firstname"
                    :error-messages="formData.errors.firstName"
                ></v-text-field>
            </v-col>

            <v-col cols="12" sm="4">
                <v-text-field
                    v-model="formData.lastName"
                    label="Lastname"
                    :error-messages="formData.errors.lastName"
                ></v-text-field>
            </v-col>

            <v-col cols="12" sm="6">
                <v-text-field
                    v-model="formData.email"
                    label="Email"
                    type="email"
                    prepend-inner-icon="mdi-email-outline"
                    readonly
                    disabled
                ></v-text-field>
            </v-col>
        </v-row>

        <v-btn
            class="mt-2"
            type="submit"
            color="teal-darken-4"
            prepend-icon="mdi-account-box-edit-outline"
            :disabled="formData.processing"
            :loading="formData.processing"
        >
            Update Information
        </v-btn>
    </v-form>
</template>
