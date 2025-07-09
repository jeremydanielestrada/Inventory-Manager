<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "../TextInput.vue";

//Load Variables
const formData = useForm({
    firstName: null,
    lastName: null,
    email: null,
    password: null,
    password_confirmation: null,
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
                <TextInput
                    name="First Name"
                    type="text"
                    v-model="formData.firstName"
                    :message="formData.errors.firstName"
                />
            </v-col>

            <v-col cols="12" sm="6">
                <TextInput
                    name="Last Name"
                    type="text"
                    v-model="formData.lastName"
                    :message="formData.errors.lastName"
                />
            </v-col>

            <v-col cols="12">
                <TextInput
                    prepend-icon="mdi-email-outline"
                    name="Email"
                    type="email"
                    v-model="formData.email"
                    :message="formData.errors.email"
                />
            </v-col>

            <v-col cols="12" sm="6">
                <!-- <v-text-field
                    v-model="formData.password"
                    label="Password"
                    prepend-inner-icon="mdi-lock-outline"
                    :type="isPasswordVisible ? 'text' : 'password'"
                    :append-inner-icon="
                        isPasswordVisible ? 'mdi-eye-off' : 'mdi-eye'
                    "
                    @click:append-inner="isPasswordVisible = !isPasswordVisible"
                ></v-text-field> -->

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

            <v-col cols="12" sm="6">
                <!-- <v-text-field
                    v-model="formData.password_confirmation"
                    label=" Confirm Password"
                    prepend-inner-icon="mdi-lock-outline"
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
                </small> -->

                <TextInput
                    name="Confirm Password"
                    :type="isPasswordConfirmVisible ? 'text' : 'password'"
                    v-model="formData.password_confirmation"
                    :message="formData.errors.password_confirmation"
                    prependIcon="mdi-lock-outline"
                    :appendIcon="
                        isPasswordConfirmVisible ? 'mdi-eye-off' : 'mdi-eye'
                    "
                    @append-click="
                        isPasswordConfirmVisible = !isPasswordConfirmVisible
                    "
                />
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
