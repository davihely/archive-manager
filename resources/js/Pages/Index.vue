<script setup lang="ts">
import ConteudoPrincipal from "../Components/ConteudoPrincipal.vue";
import Header from "../Components/Header.vue";
import MenuLateral from "../Components/MenuLateral/MenuLateral.vue";
</script>

<template>
    <div class="vh-100 d-flex flex-column text-dark overflow-hidden">
        <Header />
        <div class="d-flex flex-grow-1 overflow-hidden">
            <MenuLateral />
            <ConteudoPrincipal />
        </div>
    </div>
</template>

<style scoped></style>
