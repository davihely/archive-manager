<script setup lang="ts">
import ModalBase from "../Geral/Modal.vue";
import ItemPasta from "./ItemPasta.vue";
import ProgressoBarra from "./ProgressoBarra.vue";
import type { ModalPayLoad } from "../../Interfaces/IModal";
import { ref, useTemplateRef, onMounted } from "vue";
import { onClickOutside } from "@vueuse/core";

const props = defineProps<{
    directory: { type: Array<any>; required: true };
}>();

const drowpDownAberto = ref(false);
const dropDown = useTemplateRef("dropdownRef");
const fileModalData = ref<ModalPayLoad | null>(null);
const folderModalData = ref<ModalPayLoad | null>(null);

onClickOutside(dropDown, (event) => (drowpDownAberto.value = false));
function toggleDropdown() {
    drowpDownAberto.value = !drowpDownAberto.value;
}

onMounted(() => {
    const startedFileModalData: ModalPayLoad = {
        title: "Criar Novo Arquivo",
        inputName: "Novo",
        inputValue: "",
        type: "create",
        structureType: "file",
    };

    const startedFolderModalData: ModalPayLoad = {
        title: "Criar Nova Pasta",
        inputName: "Nova",
        inputValue: "",
        type: "create",
        structureType: "folder",
    };

    fileModalData.value = startedFileModalData;
    folderModalData.value = startedFolderModalData;
});

const fileModal = useTemplateRef("fileModal");
const folderModal = useTemplateRef("folderModal");

function openFileModal() {
    fileModal.value?.open();
}

function openFolderModal() {
    folderModal.value?.open();
}
</script>
<template>
    <aside
        class="bg-body-tertiary border-end border-secondary-subtle d-flex flex-column"
        style="width: 260px"
    >
        <div class="p-3">
            <div ref="dropdownRef" class="dropdown position-relative w-100">
                <button
                    @click="toggleDropdown"
                    class="btn bg-custom-blue text-white w-100 fw-medium shadow-sm rounded-3 py-2 d-flex justify-content-center align-items-center px-3"
                    type="button"
                >
                    <span>Add New</span>
                </button>
                <Transition>
                    <ul
                        v-if="drowpDownAberto"
                        class="dropdown-menu show position-absolute w-100 shadow-sm border-secondary-subtle mt-1 z-3"
                        style="font-size: 0.875rem"
                    >
                        <li>
                            <a
                                @click="openFileModal"
                                class="dropdown-item d-flex align-items-center gap-2 py-2"
                                href="#"
                                ><i
                                    class="bi bi-file-earmark-text text-body-secondary"
                                ></i>
                                Novo Arquivo</a
                            >
                        </li>

                        <li>
                            <a
                                @click="openFolderModal"
                                class="dropdown-item d-flex align-items-center gap-2 py-2"
                                href="#"
                            >
                                <i class="bi bi-folder text-body-secondary"></i>
                                Nova Pasta
                            </a>
                        </li>

                        <li>
                            <hr
                                class="dropdown-divider border-secondary-subtle"
                            />
                        </li>

                        <li>
                            <a
                                class="dropdown-item d-flex align-items-center gap-2 py-2"
                                href="#"
                            >
                                <i
                                    class="bi bi-plus-lg text-body-secondary"
                                ></i>
                                upload file
                            </a>
                        </li>
                    </ul>
                </Transition>
            </div>
        </div>
        <ModalBase ref="fileModal" v-bind="fileModalData" />
        <ModalBase ref="folderModal" v-bind="folderModalData" />
        <ItemPasta :pastas="directory" />
        <ProgressoBarra />
    </aside>
</template>
<style scoped>
.bg-active-folder {
    background-color: #e8f0fe;
    color: #0d6efd;
}
.v-enter-active {
    transition: all 150ms ease;
}

.v-leave-active {
    transition: all 100ms ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
    transform: translateY(-10px) scale(0.95);
}
</style>
