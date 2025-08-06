<script setup>
import { watch, inject, computed } from "vue";
import { useDisplay } from "vuetify";
import { router } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";

//Inject variables value
const isDrawerVisible = inject("isDrawerVisible");
//Utilize pre-defined functions
const { mobile } = useDisplay();

const { auth } = usePage().props;

// Computed properties to check active routes
const isCategoryActive = computed(() => route().current("categories"));
const isProductsActive = computed(() => route().current("products"));
const isDashboardActive = computed(() => route().current("dashboard"));
const isAdminDashboardActive = computed(() => route().current("admin.index"));

///defining routes
//to category
const toCategory = () => router.get(route("categories"));

//to product
const toProducts = () => router.get(route("products"));

//to dashboard
const toDashboard = () => router.get(route("dashboard"));

//to admin dashboard
const toAdminDashboard = () => router.get(route("admin.index"));

//to profile
const toProfile = () => router.get(route("profile.index"));
</script>

<template>
    <v-navigation-drawer
        v-model="isDrawerVisible"
        :persistent="mobile"
        :temporary="mobile"
        :permanent="!mobile"
        width="325"
        border
    >
        <div
            class="ma-3 d-flex align-center ga-3 cursor-pointer"
            @click="toProfile"
        >
            <div>
                <h3>{{ auth.user.firstName + " " + auth.user.lastName }}</h3>
                <small class="text-disabled">{{ auth.user.email }}</small>
            </div>

            <v-avatar size="50">
                <v-img
                    :src="
                        auth.user.image
                            ? `/storage/${auth.user.image}`
                            : '/storage/avatar/default-avatar.png'
                    "
                    cover
                >
                </v-img>
            </v-avatar>
        </div>
        <v-divider></v-divider>
        <v-list>
            <v-list-item
                prepend-icon="mdi-folder-plus-outline"
                title="Products"
                link
                @click="toProducts"
                :active="isProductsActive"
                :color="isProductsActive ? 'teal-darken-2' : ''"
            />

            <v-list-item
                prepend-icon="mdi-folder-plus-outline"
                title="Dashboard"
                link
                @click="toDashboard"
                :active="isDashboardActive"
                :color="isDashboardActive ? 'teal-darken-2' : ''"
            />

            <v-list-item
                prepend-icon="mdi-folder-plus-outline"
                title="Admin Dashboard"
                link
                @click="toAdminDashboard"
                :active="isAdminDashboardActive"
                :color="isAdminDashboardActive ? 'teal-darken-2' : ''"
                v-if="$page.props.auth.user.role === 'admin'"
            />

            <v-list-item
                prepend-icon="mdi-folder-plus-outline"
                title="Add new category"
                link
                @click="toCategory"
                :active="isCategoryActive"
                :color="isCategoryActive ? 'teal-darken-2' : ''"
                v-if="$page.props.auth.user.role === 'admin'"
            />
        </v-list>
    </v-navigation-drawer>
</template>

<style scoped>
.text-deco {
    text-decoration: none;
}
</style>
