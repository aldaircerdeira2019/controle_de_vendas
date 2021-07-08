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
              <router-link
                :to="{ name: 'admin.empresa' }"
                class="list-group-item list-group-item-action"
              >
                Empresas
              </router-link>
              <router-link
                :to="{ name: 'admin.relatorio' }"
                class="list-group-item list-group-item-action"
              >
                Relatorio
              </router-link>
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
