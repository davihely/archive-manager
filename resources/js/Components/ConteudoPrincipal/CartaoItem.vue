<script setup lang="ts">
import { Link, usePage } from "@inertiajs/vue3";
import type INoPasta from "../../Interfaces/INoPasta";
import { obterIconeArquivo } from "../../Utils/arquivoTipo";

const props = defineProps<{
    item: INoPasta;
}>();

const emit = defineEmits<{
    (e: "abrir-arquivo", item: INoPasta): void;
}>();

const page = usePage();
</script>

<template>
    <div
        class="card file-card rounded-4 p-3 cursor-pointer shadow-sm border-secondary-subtle bg-body"
    >
        <div
            class="flex-grow-1 d-flex align-items-center justify-content-center"
        >
            <i
                class="file-icon"
                :class="[
                    item.type === 'folder'
                        ? 'bi bi-folder-fill'
                        : obterIconeArquivo(item.name),
                ]"
            ></i>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-2">
            <div class="overflow-hidden">
                <div
                    class="text-body-secondary text-xs mb-1"
                    style="line-height: 1"
                >
                    {{ item.type === "folder" ? "folder" : "file" }}
                </div>
                <component
                    :is="item.type === 'folder' ? Link : 'span'"
                    :href="
                        item.type === 'folder'
                            ? `${page.url}/${item.name}`
                            : undefined
                    "
                    @click="
                        item.type === 'folder'
                            ? null
                            : emit('abrir-arquivo', item)
                    "
                    class="stretched-link d-block text-reset text-decoration-none fw-medium text-sm text-truncate pe-2"
                    style="line-height: 1.2"
                >
                    {{ item.name }}
                </component>
            </div>
        </div>
    </div>
</template>

<style scoped>
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
</style>
