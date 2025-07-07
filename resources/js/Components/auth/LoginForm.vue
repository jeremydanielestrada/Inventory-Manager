<script setup>
const formData = ref({
    email: "",
    password: "",
});

const isPasswordVisible = ref(false);
</script>

<template>
    <v-form>
        <v-row dense>
            <v-col cols="12" sm="6">
                <v-text-field
                    v-model="formData.email"
                    label="email"
                    prepend-inner-icon="mdi-email-outline"
                >
                </v-text-field>
            </v-col>

            <v-col cols="12" sm="6">
                <v-text-field
                    v-model="formData.password"
                    lable="password"
                    prepend-nner-icon="mdi-lock-outline"
                    :type="isPasswordVisible ? 'text' : 'password'"
                    :append-inner-icon="
                        isPasswordVisible ? 'mdi-eye-off' : 'mdi-eye'
                    "
                    @click:append-inner="isPasswordVisible = !isPasswordVisible"
                >
                </v-text-field
            ></v-col>
        </v-row>
        <v-btn
            class="mt-2"
            type="submit"
            color="teal-darken-2"
            prepend-icon="mdi-login"
            block
            loading=""
            disabled=""
        >
            Login
        </v-btn>
    </v-form>
</template>
