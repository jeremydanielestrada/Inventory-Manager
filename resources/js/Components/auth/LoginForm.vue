<script setup>
import { ref } from "vue";
import TextInput from "../TextInput.vue";
import { useForm } from "@inertiajs/vue3";

const formData = useForm({
    email: "",
    password: "",
    remember: null,
});

const isPasswordVisible = ref(false);

const handleSubmit = () => {
    formData.post("/login", {
        onError: () => formData.reset(),
    });
};
</script>

<template>
    <v-form @submit.prevent="handleSubmit">
        <v-row dense>
            <v-col cols="12">
                <TextInput
                    name="Email"
                    type="email"
                    v-model="formData.email"
                    prependIcon="mdi-email-outline"
                    :message="formData.errors.email"
                />
            </v-col>

            <v-col cols="12">
                <TextInput
                    name="Password"
                    :type="isPasswordVisible ? 'text' : 'password'"
                    v-model="formData.password"
                    :message="formData.errors.password"
                    prependIcon="mdi-lock-outline"
                    :appendIcon="isPasswordVisible ? 'mdi-eye-off' : 'mdi-eye'"
                    @append-click="isPasswordVisible = !isPasswordVisible"
                />
            </v-col>

            <v-checkbox
                label="Remember me"
                v-model="formData.remember"
            ></v-checkbox>
        </v-row>
        <v-btn
            type="submit"
            color="teal-darken-2"
            prepend-icon="mdi-login"
            block
            :disabled="formData.processing"
            :loading="formData.processing"
        >
            Login
        </v-btn>
    </v-form>
</template>
