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

function onBeforeEnter(el: Element) {
    (el as HTMLElement).style.height = "0";
}

function onEnter(el: Element) {
    const element = el as HTMLElement;
    element.style.height = `${element.scrollHeight}px`;
}

function onAfterEnter(el: Element) {
    (el as HTMLElement).style.height = "";
}

function onBeforeLeave(el: Element) {
    const element = el as HTMLElement;
    element.style.height = `${element.scrollHeight}px`;
}

function onLeave(el: Element) {
    const element = el as HTMLElement;
    requestAnimationFrame(() => {
        element.style.height = "0";
    });
}
</script>

<template>
    <div class="d-flex flex-column gap-1">
        <div
            @click="alternarPasta"
            class="d-flex align-items-center gap-2 px-2 py-1 rounded cursor-pointer text-body-secondary user-select-none"
            :class="{
                'bg-primary-subtle text-primary-emphasis fw-medium':
                    item.type === 'folder' && aberto,
                'hover-bg-light': !aberto,
            }"
        >
            <i
                class="bi bi-chevron-right small chevron-icon"
                :class="{
                    invisible: item.type === 'file',
                    'chevron-rotated': aberto,
                }"
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

        <Transition
            @before-enter="onBeforeEnter"
            @enter="onEnter"
            @after-enter="onAfterEnter"
            @before-leave="onBeforeLeave"
            @leave="onLeave"
        >
            <div
                v-if="
                    item.type === 'folder' &&
                    item.children &&
                    item.children.length > 0
                "
                v-show="aberto"
                class="ps-3 mt-1 d-flex flex-column gap-1 border-start border-secondary-subtle ms-2 pasta-filhos"
            >
                <NoPasta
                    v-for="filho in item.children"
                    :key="filho.name"
                    :item="filho"
                />
            </div>
        </Transition>
    </div>
</template>

<style scoped>
.hover-bg-light:hover {
    background-color: rgba(128, 128, 128, 0.1);
}
.cursor-pointer {
    cursor: pointer;
}
.chevron-icon {
    transition: transform 150ms ease;
}
.chevron-rotated {
    transform: rotate(90deg);
}
.pasta-filhos {
    overflow: hidden;
}
.v-enter-active,
.v-leave-active {
    transition: height 200ms ease;
    overflow: hidden;
}
</style>
