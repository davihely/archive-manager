<template>
  <div class="flex-grow-1 overflow-auto px-2 py-2">
    <div class="d-flex flex-column gap-1">
      <div
        class="d-flex align-items-center gap-2 px-2 py-2 rounded-3 bg-active-folder cursor-pointer text-body"
      >
        <i class="bi bi-chevron-down small"></i>
        <i class="bi bi-folder-fill text-primary"></i>
        <span class="small fw-medium">My files</span>
      </div>

      <div class="ps-4 mt-1 d-flex flex-column gap-1">
        <div
          class="d-flex align-items-center gap-2 px-2 py-1 rounded cursor-pointer text-body-secondary"
        >
          <i class="bi bi-folder-fill text-custom-blue"></i>
          <span class="small text-truncate">Books</span>
        </div>
        <div
          class="d-flex align-items-center gap-2 px-2 py-1 rounded cursor-pointer text-body-secondary"
        >
          <i class="bi bi-folder-fill text-custom-blue"></i>
          <span class="small text-truncate">Code</span>
        </div>
      </div>
    </div>
  </div>
</template>
