export type CategoriaArquivo =
    | "imagem"
    | "pdf"
    | "video"
    | "audio"
    | "texto"
    | "desconhecido";

const ICONE_POR_EXTENSAO: Record<string, string> = {
    pdf: "bi-file-earmark-pdf-fill",
    doc: "bi-file-earmark-word-fill",
    docx: "bi-file-earmark-word-fill",
    xls: "bi-file-earmark-excel-fill",
    xlsx: "bi-file-earmark-excel-fill",
    ppt: "bi-file-earmark-ppt-fill",
    pptx: "bi-file-earmark-ppt-fill",
    zip: "bi-file-earmark-zip-fill",
    rar: "bi-file-earmark-zip-fill",
    "7z": "bi-file-earmark-zip-fill",
    png: "bi-file-earmark-image-fill",
    jpg: "bi-file-earmark-image-fill",
    jpeg: "bi-file-earmark-image-fill",
    gif: "bi-file-earmark-image-fill",
    svg: "bi-file-earmark-image-fill",
    webp: "bi-file-earmark-image-fill",
    mp3: "bi-file-earmark-music-fill",
    wav: "bi-file-earmark-music-fill",
    ogg: "bi-file-earmark-music-fill",
    mp4: "bi-file-earmark-play-fill",
    mov: "bi-file-earmark-play-fill",
    avi: "bi-file-earmark-play-fill",
    webm: "bi-file-earmark-play-fill",
    js: "bi-file-earmark-code-fill",
    ts: "bi-file-earmark-code-fill",
    php: "bi-file-earmark-code-fill",
    vue: "bi-file-earmark-code-fill",
    py: "bi-file-earmark-code-fill",
    html: "bi-file-earmark-code-fill",
    css: "bi-file-earmark-code-fill",
    json: "bi-file-earmark-code-fill",
    txt: "bi-file-earmark-text-fill",
    md: "bi-file-earmark-text-fill",
};

const CATEGORIA_POR_EXTENSAO: Record<string, CategoriaArquivo> = {
    png: "imagem",
    jpg: "imagem",
    jpeg: "imagem",
    gif: "imagem",
    svg: "imagem",
    webp: "imagem",
    pdf: "pdf",
    mp4: "video",
    mov: "video",
    avi: "video",
    webm: "video",
    mp3: "audio",
    wav: "audio",
    ogg: "audio",
    txt: "texto",
    md: "texto",
    js: "texto",
    ts: "texto",
    php: "texto",
    vue: "texto",
    py: "texto",
    html: "texto",
    css: "texto",
    json: "texto",
    xml: "texto",
    log: "texto",
};

function obterExtensao(nomeArquivo: string): string {
    return nomeArquivo.split(".").pop()?.toLowerCase() ?? "";
}

export function obterIconeArquivo(nomeArquivo: string): string {
    const icone = ICONE_POR_EXTENSAO[obterExtensao(nomeArquivo)];
    return `bi ${icone ?? "bi-file-earmark-fill"}`;
}

export function obterCategoriaArquivo(nomeArquivo: string): CategoriaArquivo {
    return CATEGORIA_POR_EXTENSAO[obterExtensao(nomeArquivo)] ?? "desconhecido";
}
