<script setup lang="ts">
import ConteudoPrincipal from "../Components/ConteudoPrincipal.vue";
import Header from "../Components/Header.vue";
import MenuLateral from "../Components/MenuLateral/MenuLateral.vue";

const props = defineProps<{
    directory: { type: Array<any>; required: true };
    currentDir: { type: Array<any>; required: true };
    breadCrumb: { type: Array<any>; required: true };
}>();
</script>

<template>
    <div class="vh-100 d-flex flex-column text-body overflow-hidden">
        <Header />
        <div class="d-flex flex-grow-1 overflow-hidden">
            <MenuLateral :directory="directory" />
            <ConteudoPrincipal
                :currentDir="currentDir"
                :breadCrumb="breadCrumb"
            />
        </div>
    </div>
</template>

<style scoped></style>
