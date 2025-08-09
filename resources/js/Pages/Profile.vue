<script setup>
import SideNavigation from "@/Layouts/navigations/SideNavigation.vue";
import PictureForm from "./Profile/PictureForm.vue";
import ProfileForm from "./Profile/ProfileForm.vue";
import PasswordForm from "./Profile/PasswordForm.vue";
import AlertNotifications from "@/Components/common/AlertNotifications.vue";
import { usePage } from "@inertiajs/vue3";
const { auth } = usePage().props;

const props = defineProps({
    user: Object,
    status: String,
});
</script>

<template>
    <Head title="Profile" />
    <SideNavigation />
    <AlertNotifications :status="status"></AlertNotifications>

    <v-container>
        <v-card class="mb-5">
            <template #title>
                <span class="text-h6 font-weight-bold">
                    <v-breadcrumbs :items="['Profile', 'Edit']">
                        <template #prepend>
                            <v-icon
                                icon="mdi-wrench"
                                size="small"
                                class="me-1"
                            ></v-icon>
                        </template>
                    </v-breadcrumbs>
                </span>
            </template>

            <template #subtitle>
                <p class="ms-4 text-wrap">
                    Edit profile information, update profile picture and change
                    password.
                </p>
            </template>
        </v-card>

        <v-row>
            <v-col cols="12" lg="4">
                <v-card>
                    <v-card-text>
                        <v-img
                            width="50%"
                            class="mx-auto rounded-circle"
                            color="blue-darken-4"
                            aspect-ratio="1"
                            :src="
                                auth.user.image
                                    ? `/storage/${auth.user.image}`
                                    : '/storage/avatar/default-avatar.png'
                            "
                            alt="Profile Picture"
                            cover
                        >
                        </v-img>

                        <h3 class="d-flex align-center justify-center mt-5">
                            <v-icon class="me-2" icon="mdi-account-badge">
                            </v-icon>
                            {{ auth.user.role }}
                        </h3>

                        <v-divider class="my-5"></v-divider>

                        <div class="text-center">
                            <h4 class="my-2">
                                {{
                                    auth.user.firstName +
                                    " " +
                                    auth.user.lastName
                                }}
                            </h4>
                            <h4 class="my-2">
                                {{ auth.user.email }}
                            </h4>
                        </div>
                    </v-card-text>
                </v-card>
            </v-col>

            <v-col cols="12" lg="8">
                <v-card class="mb-5" title="Profile Picture">
                    <v-card-text>
                        <!-- Edit pofile -->
                        <PictureForm></PictureForm>
                    </v-card-text>
                </v-card>

                <v-card class="mb-5" title="Profile Information">
                    <v-card-text>
                        <ProfileForm></ProfileForm>
                    </v-card-text>
                </v-card>

                <v-card class="mb-5" title="Profile Information">
                    <v-card-text>
                        <PasswordForm></PasswordForm>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
