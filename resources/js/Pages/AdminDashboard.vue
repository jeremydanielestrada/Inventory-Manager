<script setup>
import SideNavigation from "@/Layouts/navigations/SideNavigation.vue";
import PaginationLinks from "@/Components/PaginationLinks.vue";
import { useForm, router } from "@inertiajs/vue3";
import { useDisplay } from "vuetify";

const props = defineProps({
    users: Object,
    categories: Object,
});

const params = route().params;

const form = useForm({
    search: params.search,
});

const { mobile } = useDisplay();

const search = () => {
    router.get(route("admin.index"), {
        search: form.search,
    });
};

const refreshFilter = () => {
    router.get(route("admin.index"), {
        search: null,
    });
};

//Get category color
function getCategoryColor(category) {
    const colorMap = {
        "Category 1": "teal-accent-3",
        "Category 2": "cyan-accent-3",
        "Category 3": "light-blue-accent-3",
    };
    return colorMap[category];
}

console.log(props.categories);
</script>

<template>
    <Head title="Admin Dashboard" />
    <SideNavigation></SideNavigation>

    <v-row>
        <v-col cols="8" sm="6" md="4" lg="3">
            <h3>Users</h3>
            <v-form @submit.prevent="search">
                <v-text-field
                    type="search"
                    v-model="form.search"
                    label="Search User"
                    variant="outlined"
                    density="compact"
                    append-inner-icon="mdi-magnify"
                    clearable
                ></v-text-field>
            </v-form>
        </v-col>

        <v-col cols="4" sm="6" md="8" lg="9" class="d-flex align-center">
            <v-btn icon size="30" @click="refreshFilter">
                <v-icon>mdi-refresh</v-icon>
            </v-btn>
        </v-col>

        <v-col cols="12" sm="12" lg="12" md="12">
            <v-card title="Progress Data">
                <v-card-text class="d-flex align-center justify-space-around">
                    <div
                        v-for="category in categories"
                        :key="category.id"
                        s
                        class="d-flex flex-column align-center"
                    >
                        <v-progress-circular
                            :model-value="category.percentage"
                            :rotate="360"
                            :size="mobile ? 80 : 200"
                            :width="mobile ? 10 : 20"
                            :color="
                                category.percentage === 0
                                    ? 'grey'
                                    : getCategoryColor(category.category_name)
                            "
                        >
                            {{ category.percentage }} %
                        </v-progress-circular>
                        <v-chip
                            :color="getCategoryColor(category.category_name)"
                            class="ma-2"
                            >{{ category.category_name }}</v-chip
                        >
                    </div>
                </v-card-text>
            </v-card>
        </v-col>
        <v-col cols="12" sm="12" lg="12" md="12" xs="6">
            <div v-if="users.data.length">
                <v-table hover>
                    <thead>
                        <tr class="bg-teal-lighten-4">
                            <th class="text-left">Name</th>
                            <th class="text-left">Role</th>
                            <th class="text-left">Products</th>
                            <th class="text-left">Product Status</th>
                            <th class="text-left">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users.data" :key="user.id">
                            <td class="d-flex flex-column ga-2 mt-4">
                                <p>
                                    {{ user.firstName + " " + user.lastName }}
                                </p>

                                <small class="text-disabled">{{
                                    user.email
                                }}</small>
                            </td>
                            <td>
                                {{ user.role }}
                            </td>
                            <td>
                                {{ user.products.length }}
                            </td>
                            <td>
                                <p v-if="user.products.length === 0">
                                    No Stock
                                    <v-icon color="error">mdi-circle</v-icon>
                                </p>

                                <p v-else-if="user.products.length <= 5">
                                    Low Stock
                                    <v-icon color="warning">mdi-circle</v-icon>
                                </p>

                                <p v-else>
                                    On Stock
                                    <v-icon color="green">mdi-circle</v-icon>
                                </p>
                            </td>
                            <td>
                                <Link
                                    :href="route('user.show', user.id)"
                                    class="text-decoration-none text-teal-lighten-3"
                                    v-if="user.products.length"
                                >
                                    <v-icon>mdi-eye-arrow-right</v-icon>
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </v-table>
            </div>

            <div class="text-center" v-else>
                You dont have any products, go to products to add
            </div>
        </v-col>
    </v-row>

    <!-- Pagination -->
    <PaginationLinks
        :paginator="users"
        v-if="Object.keys(users.data).length > 0"
    />
</template>
