<script setup>
import SideNavigation from "@/Layouts/navigations/SideNavigation.vue";
import PaginationLinks from "@/Components/PaginationLinks.vue";

defineProps({
    users: Object,
});
</script>

<template>
    <Head title="Admin Dashboard" />
    <SideNavigation></SideNavigation>

    <v-row>
        <v-col cols="12">
            <h3>Your Products</h3>
        </v-col>

        <v-col cols="12">
            <div v-if="users.data.length">
                <v-table hover>
                    <thead>
                        <tr class="bg-teal-lighten-4">
                            <th class="text-left">Name</th>
                            <th class="text-left">Role</th>
                            <th class="text-left">Products</th>
                            <th class="text-left">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users.data" :key="user.id">
                            <td>{{ user.firstName + " " + user.lastName }}</td>
                            <td>
                                {{ user.role }}
                            </td>
                            <td>
                                {{ user.products.length }}
                            </td>
                            <td>View User</td>
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
