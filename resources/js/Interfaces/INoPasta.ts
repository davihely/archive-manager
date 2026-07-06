export default interface INoPasta {
    name: string;
    type: "folder" | "file";
    children?: INoPasta[];
}
