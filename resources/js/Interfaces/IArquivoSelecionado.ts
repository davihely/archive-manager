import type { CategoriaArquivo } from "../Utils/arquivoTipo";

export default interface IArquivoSelecionado {
    fileName: string;
    fileIcon?: string;
    fileConteudo: string | null;
    fileCategoria: CategoriaArquivo;
    fileUrl: string;
}
