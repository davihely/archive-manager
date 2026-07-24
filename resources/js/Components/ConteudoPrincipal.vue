<script setup lang="ts">
import { Link, usePage } from "@inertiajs/vue3";
import Breadcrumb from "primevue/breadcrumb";
import { route } from "ziggy-js";

const page = usePage();

const props = defineProps<{
    currentDir: { type: Array<any>; required: true };
    breadCrumb: { type: Array<any>; required: true };
}>();
</script>

<template>
    <main class="flex-grow-1 overflow-auto p-4 bg-body-tertiary">
        <div
            class="d-flex align-items-center gap-2 text-body-secondary mb-4 border-bottom border-secondary-subtle pb-3"
        >
            <button
                class="btn btn-sm bg-body-secondary text-body-secondary p-1"
            >
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

        <div
            class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4"
        >
            <div class="col" v-for="dir in props.currentDir" :key="dir.name">
                <div
                    class="card file-card rounded-4 p-3 cursor-pointer shadow-sm border-secondary-subtle bg-body"
                >
                    <div
                        class="flex-grow-1 d-flex align-items-center justify-content-center"
                    >
                        <i
                            class="file-icon"
                            :class="[
                                dir.type === 'folder'
                                    ? 'bi bi-folder-fill'
                                    : 'bi bi-file-earmark-fill',
                            ]"
                        ></i>
                    </div>
                    <div
                        class="d-flex justify-content-between align-items-center mt-2"
                    >
                        <div class="overflow-hidden">
                            <div
                                class="text-body-secondary text-xs mb-1"
                                style="line-height: 1"
                            >
                                {{ dir.type === "folder" ? "folder" : "file" }}
                            </div>
                            <Link
                                :href="`${page.url}/${dir.name}`"
                                class="stretched-link d-block text-reset text-decoration-none fw-medium text-sm text-truncate pe-2"
                                style="line-height: 1.2"
                            >
                                {{ dir.name }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<style scoped>
.bg-custom-light {
    background-color: #f5f6f8;
}

.file-card {
    position: relative;
    height: 160px;
    border: 1px solid #e5e7eb;
    transition: all 0.2s ease-in-out;
}
.file-card:hover {
    box-shadow:
        0 4px 6px -1px rgba(0, 0, 0, 0.1),
        0 2px 4px -1px rgba(0, 0, 0, 0.06);
}
[data-bs-theme="dark"] .file-card:hover {
    box-shadow:
        0 4px 6px -1px rgba(255, 255, 255, 0.06),
        0 2px 4px -1px rgba(255, 255, 255, 0.04);
}
.file-card-active {
    border-color: #93c5fd !important;
    box-shadow: 0 0 0 1px #93c5fd !important;
}

.file-icon {
    font-size: 64px;
    line-height: 1;
}
.file-icon.bi-folder-fill {
    color: #52a8f2;
}
.file-icon.bi-file-earmark-fill {
    color: #adb5bd;
}

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
