<script setup lang="ts">
import { useDark, useToggle } from '@vueuse/core'
import { computed } from 'vue'

const isDark = useDark({
  selector: 'html',
  attribute: 'data-bs-theme',
  valueDark: 'dark',
  valueLight: 'light',
})

const toggleDark = useToggle(isDark)
const [value, toggle] = useToggle()
const iconTheme = computed(() => (isDark.value ? 'bi bi-moon' : 'bi bi-sun'))
const textTheme = computed(() => (isDark.value ? 'Escuro' : 'Claro'))
</script>
<template>
  <header
    class="d-flex align-items-center justify-content-between px-4 py-2 bg-body-tertiary border-bottom shadow-sm z-1"
  >
    <div class="d-flex align-items-center gap-4">
      <div class="fw-semibold fs-5 text-body">Arquivos</div>
      <div class="position-relative">
        <i
          class="bi bi-search position-absolute top-50 translate-middle-y text-body-secondary ms-3"
        ></i>
        <input
          type="text"
          placeholder="Search"
          class="form-control form-control-sm ps-5 rounded-3 search-button"
        />
      </div>
    </div>

    <div class="d-flex align-items-center gap-3">
      <div class="d-flex align-items-center gap-2 border-end pe-3 border-secondary-subtle">
        <button @click="toggleDark()" class="btn btn-sm text-body-secondary">
          <i :class="iconTheme"></i> {{ textTheme }}
        </button>
      </div>
      <button class="btn btn-sm bg-body-secondary text-body-secondary">
        <i class="bi bi-eye fs-5"></i>
      </button>
      <div
        class="d-flex align-items-center bg-body-secondary rounded p-1 border border-secondary-subtle"
      >
        <button class="btn btn-sm text-body-secondary py-0 px-2">
          <i class="bi bi-list fs-5"></i>
        </button>
        <button class="btn btn-sm bg-custom-blue shadow-sm py-0 px-2 text-white">
          <i class="bi bi-grid fs-5"></i>
        </button>
      </div>
    </div>
  </header>
</template>

<style scoped>
.search-button {
  width: 400px;
  padding-top: 0.4rem;
  padding-bottom: 0.4rem;
}
</style>
