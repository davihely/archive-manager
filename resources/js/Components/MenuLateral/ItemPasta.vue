<script setup lang="ts">
const props = defineProps<{
    directory: { type: Array<any>; required: true };
}>();
console.log(props.directory);
</script>
<template>
    <div class="flex-grow-1 overflow-auto px-2 py-2">
        <div class="d-flex flex-column gap-1">
            <div
                class="d-flex align-items-center gap-2 px-2 py-2 rounded-3 bg-active-folder cursor-pointer text-body"
            >
                <i class="bi bi-chevron-down small"></i>
                <i class="bi bi-folder-fill text-primary"></i>
                <span class="small fw-medium">Temp</span>
            </div>

            <div
                class="ps-3 mt-1 d-flex flex-column gap-1 border-start border-secondary-subtle ms-2"
            >
                <div
                    class="d-flex align-items-center gap-2 px-2 py-1 rounded cursor-pointer text-body-secondary"
                >
                    <i class="bi bi-chevron-down invisible small"></i>
                    <i class="bi bi-file-earmark-text text-secondary"></i>
                    <span class="small text-truncate">teste.txt</span>
                </div>

                <div class="d-flex flex-column gap-1">
                    <div
                        class="d-flex align-items-center gap-2 px-2 py-1 rounded cursor-pointer text-body"
                    >
                        <i class="bi bi-chevron-down small"></i>
                        <i class="bi bi-folder-fill text-custom-blue"></i>
                        <span class="small fw-medium text-truncate">teste</span>
                    </div>

                    <div
                        class="ps-3 mt-1 d-flex flex-column gap-1 border-start border-secondary-subtle ms-2"
                    >
                        <div
                            class="d-flex align-items-center gap-2 px-2 py-1 rounded cursor-pointer text-body-secondary"
                        >
                            <i class="bi bi-chevron-down invisible small"></i>
                            <i
                                class="bi bi-file-earmark-code text-secondary"
                            ></i>
                            <span class="small text-truncate">vapo.php</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
