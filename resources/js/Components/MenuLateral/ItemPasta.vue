<script setup lang="ts">
import NoPasta from "../Geral/NoPasta.vue";
import type INoPasta from "../../Interfaces/INoPasta.ts";

const props = defineProps<{
    pastas?: INoPasta[];
}>();
console.log(props.pastas);
</script>

<template>
    <div class="flex-grow-1 overflow-auto px-2 py-2">
        <div class="d-flex flex-column gap-1">
            <template v-if="pastas && pastas.length > 0">
                <NoPasta v-for="item in pastas" :key="item.name" :item="item" />
            </template>

            <div v-else class="text-center text-body-secondary small py-4">
                <i class="bi bi-folder-x fs-4 d-block mb-1"></i>
                <span>Nenhum arquivo encontrado</span>
            </div>
        </div>
    </div>
</template>
