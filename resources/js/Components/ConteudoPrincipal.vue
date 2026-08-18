<script setup lang="ts">
import { useTemplateRef, ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import VisualizadorArquivo from "./Geral/VisualizadorArquivo.vue";
import BarraNavegacao from "./ConteudoPrincipal/BarraNavegacao.vue";
import CartaoItem from "./ConteudoPrincipal/CartaoItem.vue";
import axios from "axios";
import { route } from "ziggy-js";
import type INoPasta from "../Interfaces/INoPasta";
import type IBreadcrumb from "../Interfaces/IBreadcrumb";
import type IArquivoSelecionado from "../Interfaces/IArquivoSelecionado";
import { obterIconeArquivo, obterCategoriaArquivo } from "../Utils/arquivoTipo";
import ContextMenu from "primevue/contextmenu";

const page = usePage();

const props = defineProps<{
    currentDir: INoPasta[];
    breadCrumb: IBreadcrumb[];
}>();

const arquivoModal = useTemplateRef("arquivoModal");
const conteudoArquivo = ref("");
const arquivoSelecionadoData = ref<IArquivoSelecionado>();

const abrirArquivo = (dir: INoPasta) => {
    const arquivo = `${page.url}/${dir.name}`;
    const categoria = obterCategoriaArquivo(dir.name);

    arquivoSelecionadoData.value = {
        fileName: dir.name,
        fileIcon: obterIconeArquivo(dir.name),
        fileConteudo: null,
        fileCategoria: categoria,
        fileUrl: route("arquivo.raw", { arquivo }),
    };
    arquivoModal.value?.open();

    if (categoria === "texto") {
        getArquivoConteudo(arquivo).then((conteudo) => {
            arquivoSelecionadoData.value!.fileConteudo = conteudo;
        });
    }
};

const abrirMenuBotaoDireito = (dir: INoPasta) => {
    console.log(dir);
    selectedStructure.value = dir;
    menu.value.show(event);
};

const getArquivoConteudo = async (arquivo: string) => {
    const url = route("arquivo.conteudo", { arquivo });
    const response = await axios.get(url);

    return response.data.conteudo;
};

const menu = ref();

const selectedStructure = ref();

const items = ref([
    {
        label: "Renomear",
        icon: "bi bi-pencil-square",
        command: () => {
            alert("alterar");
        },
    },
    {
        label: "Excluir",
        icon: "bi bi-trash",
        command: () => {
            const url = route("estrutura.destroy", { selectedStructure });
        },
    },
]);
</script>

<template>
    <main class="flex-grow-1 overflow-auto p-4 bg-body-tertiary">
        <BarraNavegacao :breadCrumb="props.breadCrumb" />

        <div
            class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4"
        >
            <div class="col" v-for="dir in props.currentDir" :key="dir.name">
                <CartaoItem
                    :item="dir"
                    @abrir-arquivo="abrirArquivo"
                    @abrir-menu-botao-direito="abrirMenuBotaoDireito"
                />
            </div>
            <ContextMenu ref="menu" :model="items" />
        </div>
        <VisualizadorArquivo
            ref="arquivoModal"
            v-bind="arquivoSelecionadoData"
        />
    </main>
</template>
<style>
.p-contextmenu {
    background-color: var(--bs-body-bg) !important;
    border: 1px solid var(--bs-border-color) !important;
    border-radius: 0.5rem !important;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
    padding: 0.25rem !important;
    font-size: 0.875rem !important;
    min-width: 11rem;
}

.p-contextmenu-item-link {
    display: flex !important;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0.75rem !important;
    border-radius: 0.375rem;
    color: var(--bs-body-color) !important;
    text-decoration: none !important;
    cursor: pointer;
}

.p-contextmenu-item-link:hover {
    background-color: var(--bs-tertiary-bg) !important;
}

.p-contextmenu-item-icon {
    color: var(--bs-secondary-color) !important;
    font-size: 0.85rem;
}

.p-contextmenu-item-label {
    line-height: 1;
}

.p-contextmenu-separator {
    border-top: 1px solid var(--bs-border-color) !important;
    margin: 0.25rem 0;
}
</style>
