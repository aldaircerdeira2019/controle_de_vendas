<template>
  <div>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
      <div class="container">
        <router-link :to="{ name: 'home' }" class="navbar-brand" href="#"
          >Home</router-link
        >
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <router-link :to="{ name: 'order' }" class="nav-link">
                Meus Pedidos
              </router-link>
            </li>
          </ul>

          <ul v-if="authUser" class="navbar-nav ml-auto">
            <li v-if="this.$acl.hasPermissionTo('admin_view')" class="nav-item">
              <router-link :to="{ name: 'admin.empresa' }" class="nav-link">
                Administrador
              </router-link>
            </li>
            <li class="nav-item dropdown">
              <a
                id="navbarDropdown"
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                {{ authUser.name }}
              </a>

              <div
                class="dropdown-menu dropdown-menu"
                aria-labelledby="navbarDropdown"
              >
                <a class="dropdown-item" @click.prevent="logout" href="#">
                  Sair
                </a>
              </div>
            </li>
          </ul>

          <ul v-else class="navbar-nav ml-auto">
            <li class="nav-item">
              <router-link :to="{ name: 'login' }" class="nav-link">
                Entrar
              </router-link>
            </li>

            <li class="nav-item">
              <router-link :to="{ name: 'register' }" class="nav-link">
                Registrar
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>
<script>
import api from "../../../api/auth";
import ACL from "../../../plugin/acl";
export default {
  name: "Navbar",
  data() {
    return {
      authUser: null,
    };
  },
  mounted() {
    this.authenticated();
  },
  methods: {
    logout() {
      api.logout().then((r) => {
        window.location.href = "/spa/";
      });
    },
    authenticated() {
      api
        .authenticated()
        .then((r) => {
          this.authUser = r.data;
          Vue.prototype.$acl = new ACL.Acl(r.data);
          localStorage.setItem("auth", "true");
        })
        .catch(() => {
          this.authUser = null;
          localStorage.removeItem("auth");
        });
    },
  },
};
</script>
