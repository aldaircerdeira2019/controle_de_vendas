<template>
  <div class="col-md-3 sm-4">
    <div class="card">
      <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
        <div class="container">
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#menu"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="menu">
            <div class="list-group">
              <button
                type="button"
                class="list-group-item list-group-item-action active"
                aria-current="true"
                disabled
              >
                Administrador
              </button>
              <button
                type="button"
                class="list-group-item list-group-item-action"
              >
                A second item
              </button>
              <button
                type="button"
                class="list-group-item list-group-item-action"
              >
                A third button item
              </button>
              <button
                type="button"
                class="list-group-item list-group-item-action"
              >
                A fourth button item
              </button>
              <button
                type="button"
                class="list-group-item list-group-item-action"
                disabled
              >
                A disabled button item
              </button>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  name: "Menu",
};
</script>
