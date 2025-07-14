<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
const props = defineProps({
    paginator: Object,
});

const model = ref(props.paginator.current_page);

function onPageChange(page) {
    if (page !== props.paginator.current_page) {
        router.get(
            window.location.pathname,
            { page },
            { preserveScroll: true, preserveState: true }
        );
    }
}
</script>

<template>
    <div class="text-center">
        <v-pagination
            v-model="model"
            :length="paginator.last_page"
            :total-visible="5"
            @update:modelValue="onPageChange"
        ></v-pagination>
    </div>
</template>
