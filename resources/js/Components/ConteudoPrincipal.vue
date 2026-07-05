<template>
  <main class="flex-grow-1 overflow-auto p-4 bg-body-tertiary">
    <div
      class="d-flex align-items-center gap-2 text-body-secondary mb-4 border-bottom border-secondary-subtle pb-3"
    >
      <button class="btn btn-sm bg-body-secondary text-body-secondary p-1">
        <i class="bi bi-arrow-clockwise"></i>
      </button>
      <span class="small cursor-pointer fw-medium text-body hover-underline">My files</span>
      <i class="bi bi-chevron-right small text-body-secondary"></i>
      <span class="small fw-medium text-body">Code</span>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">
      <div class="col">
        <div
          class="card file-card rounded-4 p-3 cursor-pointer shadow-sm border-secondary-subtle bg-body"
        >
          <div class="flex-grow-1 d-flex align-items-center justify-content-center">
            <svg
              width="64"
              height="64"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M4 4C2.89543 4 2 4.89543 2 6V18C2 19.1046 2.89543 20 4 20H20C21.1046 20 22 19.1046 22 18V10C22 8.89543 21.1046 8 20 8H12L10 4H4Z"
                fill="#52A8F2"
              />
            </svg>
          </div>
          <div class="d-flex justify-content-between align-items-center mt-2">
            <div class="overflow-hidden">
              <div class="text-body-secondary text-xs mb-1" style="line-height: 1">Folder</div>
              <div class="fw-medium text-body text-sm text-truncate pe-2" style="line-height: 1.2">
                Project Images
              </div>
            </div>

            <div class="dropdown">
              <button
                class="btn btn-sm text-body-secondary p-1 border-0"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-three-dots-vertical"></i>
              </button>
              <ul
                class="dropdown-menu shadow-sm border-secondary-subtle mt-1"
                style="font-size: 0.875rem; min-width: 200px"
              >
                <li>
                  <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#"
                    ><i class="bi bi-copy text-body-secondary"></i> Copy
                    <span class="ms-auto text-body-secondary" style="font-size: 0.75rem"
                      >Ctrl+C</span
                    ></a
                  >
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#"
                    ><i class="bi bi-scissors text-body-secondary"></i> Cut
                    <span class="ms-auto text-body-secondary" style="font-size: 0.75rem"
                      >Ctrl+X</span
                    ></a
                  >
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#"
                    ><i class="bi bi-clipboard text-body-secondary"></i> Paste
                    <span class="ms-auto text-body-secondary" style="font-size: 0.75rem"
                      >Ctrl+V</span
                    ></a
                  >
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#"
                    ><i class="bi bi-pencil text-body-secondary"></i> Rename
                    <span class="ms-auto text-body-secondary" style="font-size: 0.75rem"
                      >F2</span
                    ></a
                  >
                </li>
                <li><hr class="dropdown-divider border-secondary-subtle" /></li>
                <li>
                  <a class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger" href="#"
                    ><i class="bi bi-trash"></i> Delete
                    <span class="ms-auto text-body-secondary" style="font-size: 0.75rem"
                      >Del</span
                    ></a
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div
          class="card file-card rounded-4 p-3 cursor-pointer shadow-sm border-secondary-subtle bg-body"
        >
          <div class="flex-grow-1 d-flex align-items-center justify-content-center">
            <svg
              width="64"
              height="64"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M4 4C2.89543 4 2 4.89543 2 6V18C2 19.1046 2.89543 20 4 20H20C21.1046 20 22 19.1046 22 18V10C22 8.89543 21.1046 8 20 8H12L10 4H4Z"
                fill="#52A8F2"
              />
            </svg>
          </div>
          <div class="d-flex justify-content-between align-items-center mt-2">
            <div class="overflow-hidden">
              <div class="text-body-secondary text-xs mb-1" style="line-height: 1">Folder</div>
              <div class="fw-medium text-body text-sm text-truncate pe-2" style="line-height: 1.2">
                Vue Components
              </div>
            </div>

            <div class="dropdown">
              <button
                class="btn btn-sm text-body-secondary p-1 border-0"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-three-dots-vertical"></i>
              </button>
              <ul
                class="dropdown-menu shadow-sm border-secondary-subtle mt-1"
                style="font-size: 0.875rem; min-width: 200px"
              >
                <li>
                  <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#"
                    ><i class="bi bi-copy text-body-secondary"></i> Copy
                    <span class="ms-auto text-body-secondary" style="font-size: 0.75rem"
                      >Ctrl+C</span
                    ></a
                  >
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#"
                    ><i class="bi bi-scissors text-body-secondary"></i> Cut
                    <span class="ms-auto text-body-secondary" style="font-size: 0.75rem"
                      >Ctrl+X</span
                    ></a
                  >
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#"
                    ><i class="bi bi-clipboard text-body-secondary"></i> Paste
                    <span class="ms-auto text-body-secondary" style="font-size: 0.75rem"
                      >Ctrl+V</span
                    ></a
                  >
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#"
                    ><i class="bi bi-pencil text-body-secondary"></i> Rename
                    <span class="ms-auto text-body-secondary" style="font-size: 0.75rem"
                      >F2</span
                    ></a
                  >
                </li>
                <li><hr class="dropdown-divider border-secondary-subtle" /></li>
                <li>
                  <a class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger" href="#"
                    ><i class="bi bi-trash"></i> Delete
                    <span class="ms-auto text-body-secondary" style="font-size: 0.75rem"
                      >Del</span
                    ></a
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div
          class="card file-card rounded-4 p-3 cursor-pointer shadow-sm border-secondary-subtle bg-body"
        >
          <div class="flex-grow-1 d-flex align-items-center justify-content-center">
            <svg
              width="48"
              height="64"
              viewBox="0 0 38 48"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M0 4C0 1.79086 1.79086 0 4 0H26.3431C27.404 0 28.4214 0.421427 29.1716 1.17157L36.8284 8.82843C37.5786 9.57857 38 10.596 38 11.6569V44C38 46.2091 36.2091 48 34 48H4C1.79086 48 0 46.2091 0 44V4Z"
                fill="#3B99E0"
              />
              <path d="M26 0V8C26 10.2091 27.7909 12 30 12H38" fill="#2E80BF" fillOpacity="0.5" />
              <rect x="8" y="20" width="22" height="2" rx="1" fill="white" fillOpacity="0.8" />
              <rect x="8" y="28" width="22" height="2" rx="1" fill="white" fillOpacity="0.8" />
              <rect x="8" y="36" width="14" height="2" rx="1" fill="white" fillOpacity="0.8" />
            </svg>
          </div>
          <div class="d-flex justify-content-between align-items-center mt-2">
            <div class="overflow-hidden">
              <div class="text-body-secondary text-xs mb-1" style="line-height: 1">File</div>
              <div class="fw-medium text-body text-sm text-truncate pe-2" style="line-height: 1.2">
                README.md
              </div>
            </div>

            <div class="dropdown">
              <button
                class="btn btn-sm text-body-secondary p-1 border-0"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-three-dots-vertical"></i>
              </button>
              <ul
                class="dropdown-menu shadow-sm border-secondary-subtle mt-1"
                style="font-size: 0.875rem; min-width: 200px"
              >
                <li>
                  <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#"
                    ><i class="bi bi-copy text-body-secondary"></i> Copy
                    <span class="ms-auto text-body-secondary" style="font-size: 0.75rem"
                      >Ctrl+C</span
                    ></a
                  >
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#"
                    ><i class="bi bi-scissors text-body-secondary"></i> Cut
                    <span class="ms-auto text-body-secondary" style="font-size: 0.75rem"
                      >Ctrl+X</span
                    ></a
                  >
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#"
                    ><i class="bi bi-clipboard text-body-secondary"></i> Paste
                    <span class="ms-auto text-body-secondary" style="font-size: 0.75rem"
                      >Ctrl+V</span
                    ></a
                  >
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#"
                    ><i class="bi bi-pencil text-body-secondary"></i> Rename
                    <span class="ms-auto text-body-secondary" style="font-size: 0.75rem"
                      >F2</span
                    ></a
                  >
                </li>
                <li><hr class="dropdown-divider border-secondary-subtle" /></li>
                <li>
                  <a class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger" href="#"
                    ><i class="bi bi-trash"></i> Delete
                    <span class="ms-auto text-body-secondary" style="font-size: 0.75rem"
                      >Del</span
                    ></a
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>
<style scoped>
.bg-custom-light {
  background-color: #f5f6f8;
}

.file-card {
  height: 160px;
  border: 1px solid #e5e7eb;
  transition: all 0.2s ease-in-out;
}
.file-card:hover {
  box-shadow:
    0 4px 6px -1px rgba(0, 0, 0, 0.1),
    0 2px 4px -1px rgba(0, 0, 0, 0.06);
}
.file-card-active {
  border-color: #93c5fd !important;
  box-shadow: 0 0 0 1px #93c5fd !important;
}
</style>
