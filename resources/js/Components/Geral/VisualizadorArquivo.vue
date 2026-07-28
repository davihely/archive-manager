<script setup lang="ts">
import { ref, defineExpose } from "vue";
import { route } from "ziggy-js";
import { usePage } from "@inertiajs/vue3";
import Dialog from "primevue/dialog";
import axios from "axios";
import type { CategoriaArquivo } from "../../Utils/arquivoTipo";

const page = usePage();

const props = defineProps<{
    fileName: string;
    fileIcon?: string;
    fileConteudo?: string | null;
    fileCategoria?: CategoriaArquivo;
    fileUrl?: string;
}>();

const visible = ref(false);

function open() {
    visible.value = true;
}

function close() {
    visible.value = false;
}

defineExpose({
    open,
    close,
});

const downloadArquivo = async () => {
    const arquivo = `${page.url}/${props.fileName}`;
    const rota = route("arquivo.download", { arquivo });
    const response = await axios.get(rota, {
        responseType: "blob",
    });

    const blob = response.data;

    const fileURL = window.URL.createObjectURL(blob);

    const fileLink = document.createElement("a");
    fileLink.href = fileURL;
    fileLink.setAttribute("download", props.fileName);

    document.body.appendChild(fileLink);
    fileLink.click();

    fileLink.remove();
    window.URL.revokeObjectURL(fileURL);
};
</script>

<template>
    <Dialog
        v-model:visible="visible"
        modal
        :showHeader="false"
        :dismissableMask="true"
        :style="{ width: '90vw', height: '90vh', maxWidth: '1200px' }"
        :pt="{
            content: {
                style: 'padding: 0; background: transparent; border: none; height: 100%;',
            },
        }"
    >
        <div
            class="visualizador-content rounded-4 border border-secondary-subtle shadow-lg bg-body text-body d-flex flex-column"
        >
            <div
                class="visualizador-header d-flex align-items-center justify-content-between gap-3 px-3 py-2 border-bottom border-secondary-subtle"
            >
                <div class="d-flex align-items-center gap-2 overflow-hidden">
                    <button
                        @click="close"
                        type="button"
                        class="btn btn-sm text-body-secondary p-1"
                        aria-label="Fechar"
                    >
                        <i class="bi bi-x-lg"></i>
                    </button>
                    <i
                        class="bi"
                        :class="fileIcon ?? 'bi-file-earmark-fill'"
                    ></i>
                    <span class="fw-semibold text-body text-truncate">{{
                        fileName
                    }}</span>
                </div>

                <div class="d-flex align-items-center gap-2 flex-shrink-0">
                    <button
                        type="button"
                        class="btn btn-sm text-body-secondary p-1"
                        aria-label="Baixar"
                        @click="downloadArquivo()"
                    >
                        <i class="bi bi-download"></i>
                    </button>
                </div>
            </div>

            <div
                v-if="fileCategoria === 'texto' && !fileConteudo"
                class="text-center py-5"
            >
                <span class="spinner-border spinner-border-sm"></span>
                Carregando...
            </div>
            <pre v-else-if="fileCategoria === 'texto'" class="p-3 mb-0">{{
                fileConteudo
            }}</pre>
            <img
                v-else-if="fileCategoria === 'imagem'"
                :src="fileUrl"
                :alt="fileName"
                class="visualizador-midia"
            />
            <iframe
                v-else-if="fileCategoria === 'pdf'"
                :src="fileUrl"
                class="visualizador-midia border-0"
            ></iframe>
            <video
                v-else-if="fileCategoria === 'video'"
                :src="fileUrl"
                controls
                class="visualizador-midia"
            ></video>
            <audio
                v-else-if="fileCategoria === 'audio'"
                :src="fileUrl"
                controls
                class="w-100 mt-5 px-3"
            ></audio>
            <div v-else class="text-center py-5">
                <i class="bi bi-file-earmark-fill fs-1 text-body-secondary"></i>
                <p class="mb-0 text-body-secondary">
                    Pré-visualização não disponível para este tipo de
                    arquivo.
                </p>
            </div>
        </div>
    </Dialog>
</template>

<style scoped>
.visualizador-content {
    height: 100%;
    overflow: hidden;
}

.visualizador-header {
    flex-shrink: 0;
}

.visualizador-body {
    min-height: 0;
}

.visualizador-midia {
    flex-grow: 1;
    width: 100%;
    min-height: 0;
    object-fit: contain;
    background: #000;
}
</style>
