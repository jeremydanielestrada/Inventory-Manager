<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const formData = useForm({
    firstName: "",
    lastName: "",
    email: "",
    password: "",
    password_confirmation: "",
    role: "User",
});

const isPasswordVisible = ref(false);
const isPasswordConfirmVisible = ref(false);

const handleSubmit = () => {
    formData.post("/register", {
        onError: () => formData.reset(),
        onSuccess: () => form.reset("password"),
    });
};
</script>

<template>
    <v-form @submit.prevent="handleSubmit">
        <v-row dense>
            <v-col cols="12" sm="6">
                <v-text-field
                    v-model="formData.firstName"
                    label="First Name"
                ></v-text-field>
                <small v-if="formData.errors.firstName">{{
                    formData.errors.firstName
                }}</small>
            </v-col>

            <v-col cols="12" sm="6">
                <v-text-field
                    v-model="formData.lastName"
                    label="Last Name"
                ></v-text-field>
                <small v-if="formData.errors.lastName">{{
                    formData.errors.lastName
                }}</small>
            </v-col>

            <v-col cols="12">
                <v-text-field
                    v-model="formData.email"
                    label="Email"
                ></v-text-field>
                <small v-if="formData.errors.email">{{
                    formData.errors.email
                }}</small>
            </v-col>

            <v-col cols="12" sm="6">
                <v-text-field
                    v-model="formData.password"
                    label="Password"
                    prepend-nner-icon="mdi-lock-outline"
                    :type="isPasswordVisible ? 'text' : 'password'"
                    :append-inner-icon="
                        isPasswordVisible ? 'mdi-eye-off' : 'mdi-eye'
                    "
                    @click:append-inner="isPasswordVisible = !isPasswordVisible"
                ></v-text-field>
            </v-col>

            <v-col cols="12" sm="6">
                <v-text-field
                    v-model="formData.password_confirmation"
                    label=" Confirm Password"
                    prepend-nner-icon="mdi-lock-outline"
                    :type="isPasswordConfirmVisible ? 'text' : 'password'"
                    :append-inner-icon="
                        isPasswordConfirmVisible ? 'mdi-eye-off' : 'mdi-eye'
                    "
                    @click:append-inner="
                        isPasswordConfirmVisible = !isPasswordConfirmVisible
                    "
                ></v-text-field>
                <small v-if="formData.errors.password_confirmation"
                    >{{ formData.errors.password_confirmation }}
                </small>
            </v-col>
            <v-col cols="12">
                <small v-if="formData.errors.password" class="">{{
                    formData.errors.password
                }}</small>
            </v-col>
        </v-row>

        <v-btn
            type="submit"
            color="teal-darken-2"
            block
            class="mt-3"
            :disabled="formData.processing"
            :loading="formData.processing"
        >
            Submit
        </v-btn>
    </v-form>
</template>

<style scoped>
small {
    color: #d50000;
}
</style>
