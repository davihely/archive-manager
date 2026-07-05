export type TipoRequisicao = "create" | "update" | "delete";
export type StructureType = "file" | "folder";

export type ModalPayLoad = {
    title: string;
    inputName: string;
    inputValue: string;
    type: TipoRequisicao;
    structureType: StructureType;
};
