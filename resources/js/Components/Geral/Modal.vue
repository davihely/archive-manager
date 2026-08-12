<script setup lang="ts">
import { ref, defineExpose } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import type { ModalPayLoad, FormPayLoad } from "../../Interfaces/IModal";
import Dialog from "primevue/dialog";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import { onClickOutside } from "@vueuse/core";

const visible = ref(false);

const page = usePage();

const modalProps = defineProps<ModalPayLoad>();

const form = useForm<FormPayLoad>({
    inputValue: modalProps.inputValue,
    type: modalProps.type,
    structureType: modalProps.structureType,
    path: page.url,
});

function open(data: ModalPayLoad) {
    form.inputValue = data.inputValue;
    form.type = data.type;
    form.structureType = data.structureType;
    form.path = page.url.replace(/^\/+/, "");
    visible.value = true;
}

defineExpose({
    open,
});

function handleSubmit() {
    form.post("/estrutura", {
        onSuccess: () => {
            visible.value = false;
        },
        onError: () => {
            form.reset();
        },
    });
}
</script>
<template>
    <Dialog
        v-model:visible="visible"
        modal
        :showHeader="false"
        :dismissableMask="true"
        :style="{ width: '100%', maxWidth: '420px' }"
        :pt="{
            content: {
                style: 'padding: 0; background: transparent; border: none;',
            },
        }"
    >
        <form method="post" @submit.prevent="handleSubmit">
            <div
                class="modal-content rounded-4 border border-secondary-subtle shadow-lg bg-body text-body p-2"
            >
                <div
                    class="modal-header border-0 pb-0 pt-3 px-3 d-flex justify-content-between align-items-center"
                >
                    <h1
                        class="modal-title fs-5 fw-semibold text-body"
                        id="meuModal"
                    >
                        {{ modalProps.title }}
                    </h1>
                    <button
                        @click="visible = false"
                        type="button"
                        class="btn-close"
                        aria-label="Close"
                    ></button>
                </div>

                <div class="modal-body pt-4 px-3">
                    <label
                        :for="`${modalProps.structureType}NameInput`"
                        class="form-label text-body-secondary small fw-medium mb-1"
                    >
                        {{ modalProps.inputName }}
                    </label>

                    <input
                        type="text"
                        class="form-control custom-input px-3 py-2"
                        name="inputValue"
                        v-model="form.inputValue"
                        :placeholder="`Enter ${modalProps.structureType} name...`"
                        autofocus
                    />
                    <span
                        class="mt-1 block text-sm text-red-600"
                        v-if="form.errors.message"
                    >
                        {{ form.errors.message }}
                    </span>
                    <input type="hidden" name="type" v-model="form.type" />
                    <input
                        type="hidden"
                        name="structureType"
                        v-model="form.structureType"
                    />
                    <input type="hidden" name="path" v-model="form.path" />
                </div>

                <div
                    class="modal-footer border-0 pt-3 pb-3 pe-3 d-flex justify-content-end gap-2"
                >
                    <button
                        @click="visible = false"
                        type="button"
                        class="btn text-body-secondary fw-medium border-0 px-3 py-2"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary custom-btn px-4 py-2 rounded-3 shadow-sm border-0 fw-medium"
                    >
                        Confirm
                    </button>
                </div>
            </div>
        </form>
    </Dialog>
</template>

<style scoped>
:deep([data-bs-theme="dark"]) .custom-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25);
}

.custom-btn {
    --bs-btn-bg: #0d6efd;
    --bs-btn-border-color: #0d6efd;
    --bs-btn-hover-bg: #0b5ed7;
    --bs-btn-hover-border-color: #0a58ca;
    --bs-btn-focus-shadow-rgb: 49, 132, 253;
    --bs-btn-active-bg: #0a58ca;
}

:deep([data-bs-theme="dark"]) .custom-btn {
    --bs-btn-bg: #3b82f6;
    --bs-btn-border-color: #3b82f6;
    --bs-btn-hover-bg: #60a5fa;
    --bs-btn-hover-border-color: #60a5fa;
    color: #ffffff;
}
</style>
