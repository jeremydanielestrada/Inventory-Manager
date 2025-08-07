<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

//Load Variables
const formData = useForm({
    password: null,
    password_confirmation: null,
    _method: "PUT",
});

const isPasswordVisible = ref(false);
const isPasswordConfirmVisible = ref(false);

const onSubmit = () => {
    formData.post(route("profile.password"), {
        onSuccess: () => {
            formData.reset();
        },
        onError: () => console.log("Error updating password"),
    });
};
</script>

<template>
    <v-form ref="refVForm" @submit.prevent="onSubmit">
        <v-row dense>
            <v-col cols="12" sm="6">
                <v-text-field
                    v-model="formData.password"
                    prepend-inner-icon="mdi-lock-outline"
                    label="New Password"
                    :type="isPasswordVisible ? 'text' : 'password'"
                    :append-inner-icon="
                        isPasswordVisible ? 'mdi-eye-off' : 'mdi-eye'
                    "
                    @click:append-inner="isPasswordVisible = !isPasswordVisible"
                    :error-messages="formData.errors.password"
                ></v-text-field>
            </v-col>

            <v-col cols="12" sm="6">
                <v-text-field
                    v-model="formData.password_confirmation"
                    label="Password Confirmation"
                    :type="isPasswordConfirmVisible ? 'text' : 'password'"
                    :append-inner-icon="
                        isPasswordConfirmVisible ? 'mdi-eye-off' : 'mdi-eye'
                    "
                    @click:append-inner="
                        isPasswordConfirmVisible = !isPasswordConfirmVisible
                    "
                    :error-messages="formData.errors.confirm_pasowrd"
                ></v-text-field>
            </v-col>
        </v-row>
        <v-btn
            class="mt-2"
            type="submit"
            color="teal-darken-4"
            prepend-icon="mdi-key"
            :disabled="formData.processing"
            :loading="formData.processing"
        >
            Change Password
        </v-btn>
    </v-form>
</template>
