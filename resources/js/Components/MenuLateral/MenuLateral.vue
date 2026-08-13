<script setup lang="ts">
import ModalBase from "../Geral/Modal.vue";
import ItemPasta from "./ItemPasta.vue";
import ProgressoBarra from "./ProgressoBarra.vue";
import type INoPasta from "../Interfaces/INoPasta";
import type { ModalPayLoad } from "../../Interfaces/IModal";
import { ref, useTemplateRef, onMounted } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { onClickOutside } from "@vueuse/core";

const props = defineProps<{
    directory: INoPasta[];
    disk: { type: Array<any>; required: true };
}>();

const page = usePage();

const formUpload = useForm({
    file: null as File | null,
    path: "",
});

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
    fileModal.value?.open(fileModalData.value);
}

function openFolderModal() {
    folderModal.value?.open(folderModalData.value);
}

function handleSubmit() {
    const urlDecodificada = decodeURIComponent(page.url);
    formUpload.path = urlDecodificada.replace(/^\/+/, "");
    formUpload.post("/arquivo/upload");
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
                    <span>Novo</span>
                </button>
                <Transition>
                    <ul
                        v-if="drowpDownAberto"
                        class="dropdown-menu show position-absolute w-100 shadow-sm border-secondary-subtle mt-1 z-3"
                        style="font-size: 0.875rem"
                    >
                        <li>
                            <button
                                @click="(openFileModal(), toggleDropdown())"
                                class="dropdown-item d-flex align-items-center gap-2 py-2"
                            >
                                <i
                                    class="bi bi-file-earmark-text text-body-secondary"
                                ></i>
                                Novo Arquivo
                            </button>
                        </li>

                        <li>
                            <button
                                @click="(openFolderModal(), toggleDropdown())"
                                class="dropdown-item d-flex align-items-center gap-2 py-2"
                            >
                                <i class="bi bi-folder text-body-secondary"></i>
                                Nova Pasta
                            </button>
                        </li>

                        <li>
                            <hr
                                class="dropdown-divider border-secondary-subtle"
                            />
                        </li>

                        <li>
                            <form @submit.prevent>
                                <label
                                    class="dropdown-item upload-label d-flex align-items-center gap-2 py-2 mb-0"
                                >
                                    <i
                                        class="bi bi-plus-lg text-body-secondary"
                                    ></i>
                                    Upload de arquivo
                                    <input
                                        type="file"
                                        class="d-none"
                                        @change="handleSubmit"
                                        @input="
                                            formUpload.file =
                                                $event.target.files[0]
                                        "
                                    />
                                </label>
                                <div
                                    v-if="formUpload.progress"
                                    class="progress mx-3 mb-2"
                                    style="height: 4px"
                                >
                                    <div
                                        class="progress-bar"
                                        :style="{
                                            width:
                                                formUpload.progress.percentage +
                                                '%',
                                        }"
                                    ></div>
                                </div>
                                <div
                                    v-if="formUpload.errors.file"
                                    class="px-3 pb-2 small text-danger"
                                >
                                    {{ formUpload.errors.file }}
                                </div>
                            </form>
                        </li>
                    </ul>
                </Transition>
            </div>
        </div>
        <ModalBase ref="fileModal" v-bind="fileModalData" />
        <ModalBase ref="folderModal" v-bind="folderModalData" />
        <ItemPasta :pastas="directory" />
        <ProgressoBarra :disk="disk" />
    </aside>
</template>
<style scoped>
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

.upload-label {
    cursor: pointer;
}
</style>
