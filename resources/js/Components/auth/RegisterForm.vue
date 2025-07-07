<script setup>
import { ref } from "vue";

const formData = ref({
    firstName: "",
    lastName: "",
    email: "",
    password: "",
    password_confirmation,
});

const isPasswordVisible = ref(false);
</script>

<template>
    <v-form>
        <v-row dense>
            <v-col cols="12" sm="6">
                <v-text-field
                    v-model="formData.firstName"
                    label="First Name"
                ></v-text-field>
            </v-col>

            <v-col cols="12" sm="6">
                <v-text-field
                    v-model="formData.lastName"
                    label="Last Name"
                ></v-text-field>
            </v-col>

            <v-col cols="12" sm="6">
                <v-text-field
                    v-model="formData.email"
                    label="Email"
                ></v-text-field>
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
                    :type="isPasswordVisible ? 'text' : 'password'"
                    :append-inner-icon="
                        isPasswordVisible ? 'mdi-eye-off' : 'mdi-eye'
                    "
                    @click:append-inner="isPasswordVisible = !isPasswordVisible"
                ></v-text-field>
            </v-col>
        </v-row>
    </v-form>
</template>
