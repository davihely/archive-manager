<script setup lang="ts">
const props = defineProps<{
    disk: { type: Array<any>; required: true };
}>();

function progressBar() {
    return (props.disk?.freeSpace / props.disk?.totalSpace) * 100;
}
</script>

<template>
    <div class="p-4 border-top border-secondary-subtle">
        <div class="progress" style="height: 8px">
            <div
                class="progress-bar bg-custom-blue"
                role="progressbar"
                :style="{ width: `${progressBar()}%` }"
            ></div>
        </div>
        <div class="mt-2 text-body-secondary" style="font-size: 0.75rem">
            {{ disk.freeSpace }} Gb de {{ disk.totalSpace }} Gb usados
        </div>
    </div>
</template>
