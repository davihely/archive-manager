<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import Breadcrumb from "primevue/breadcrumb";
import type IBreadcrumb from "../../Interfaces/IBreadcrumb";

const props = defineProps<{
    breadCrumb: IBreadcrumb[];
}>();
</script>

<template>
    <div
        class="d-flex align-items-center gap-2 text-body-secondary mb-4 border-bottom border-secondary-subtle pb-3"
    >
        <button class="btn btn-sm bg-body-secondary text-body-secondary p-1">
            <i class="bi bi-arrow-clockwise"></i>
        </button>
        <Breadcrumb :model="props.breadCrumb">
            <template #item="{ item, label }">
                <component
                    :is="item.route ? Link : 'span'"
                    :href="item.route ? `/${item.route}` : undefined"
                    class="small fw-medium text-decoration-none"
                    :class="
                        item.route
                            ? 'text-body-secondary cursor-pointer hover-underline'
                            : 'text-body'
                    "
                >
                    {{ label }}
                </component>
            </template>
            <template #separator>
                <i class="bi bi-chevron-right small text-body-secondary"></i>
            </template>
        </Breadcrumb>
    </div>
</template>

<style scoped>
:deep(.p-breadcrumb) {
    background: transparent;
    border: none;
    padding: 0;
}
:deep(.p-breadcrumb-list) {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    list-style: none;
    margin: 0;
    padding: 0;
}
:deep(.p-breadcrumb-separator) {
    display: flex;
    align-items: center;
    margin: 0;
}
</style>
