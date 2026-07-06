<script setup lang="ts">
import { ref } from "vue";
import type INoPasta from "../../Interfaces/INoPasta.ts";

const props = defineProps<{
    item: INoPasta;
}>();

const aberto = ref(false);

function alternarPasta() {
    if (props.item.type === "folder") {
        aberto.value = !aberto.value;
    } else {
        console.log("Arquivo clicado:", props.item.name);
    }
}
</script>

<template>
    <div class="d-flex flex-column gap-1">
        <div
            @click="alternarPasta"
            class="d-flex align-items-center gap-2 px-2 py-1 rounded cursor-pointer text-body-secondary user-select-none"
            :class="{
                'bg-active-folder text-body fw-medium':
                    item.type === 'folder' && aberto,
                'hover-bg-light': !aberto,
            }"
        >
            <i
                class="bi small"
                :class="[
                    item.type === 'file'
                        ? 'bi-chevron-down invisible'
                        : aberto
                          ? 'bi-chevron-down'
                          : 'bi-chevron-right',
                ]"
            ></i>

            <i
                class="bi"
                :class="[
                    item.type === 'folder'
                        ? aberto
                            ? 'bi-folder2-open text-primary'
                            : 'bi-folder-fill text-custom-blue'
                        : 'bi-file-earmark-text text-secondary',
                ]"
            ></i>

            <span class="small text-truncate">{{ item.name }}</span>
        </div>

        <div
            v-if="
                item.type === 'folder' &&
                aberto &&
                item.children &&
                item.children.length > 0
            "
            class="ps-3 mt-1 d-flex flex-column gap-1 border-start border-secondary-subtle ms-2"
        >
            <NoPasta
                v-for="filho in item.children"
                :key="filho.name"
                :item="filho"
            />
        </div>
    </div>
</template>

<style scoped>
.hover-bg-light:hover {
    background-color: rgba(128, 128, 128, 0.1);
}
.cursor-pointer {
    cursor: pointer;
}
</style>
