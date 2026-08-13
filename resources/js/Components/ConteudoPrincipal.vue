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
    { label: "Copy", icon: "pi pi-copy" },
    { label: "Rename", icon: "pi pi-file-edit" },
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
