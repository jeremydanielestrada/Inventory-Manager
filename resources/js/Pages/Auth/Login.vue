<script setup>
import { useDisplay } from "vuetify";
import LoginForm from "@/Components/auth/LoginForm.vue";

const { mobile } = useDisplay();
</script>

<template>
    <Head title="Login" />
    <v-container fluid>
        <v-row>
            <v-col cols="12" sm="4" class="mx-auto">
                <v-card :width="!mobile ? 500 : ''">
                    <v-card-title class="text-center">
                        <h3 class="font-weight-black pa-3">
                            Inventory Manager
                        </h3>
                    </v-card-title>

                    <v-card-text>
                        <v-divider class="my-5"></v-divider>
                        <LoginForm></LoginForm>
                        <v-divider class="my-5"></v-divider>
                    </v-card-text>

                    <h4 class="ma-4">
                        Don't have an account?
                        <Link :href="route('register')" class="text-deco"
                            >Register</Link
                        >
                    </h4>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<style scoped>
.text-deco {
    text-decoration: none;
    color: #4db6ac;
}
</style>
