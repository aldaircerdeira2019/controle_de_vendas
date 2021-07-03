<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Registrar</div>

          <div class="card-body">
            <form>
              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">
                  Nome</label
                >
                <div class="col-md-6">
                  <input
                    type="text"
                    :class="`form-control ${errors.name ? 'is-invalid' : ''}`"
                    id="name"
                    v-model="form.name"
                    autofocus
                  />
                  <div class="invalid-feedback" v-if="errors.name">
                    {{ errors.name[0] }}
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label
                  for="email"
                  class="col-md-4 col-form-label text-md-right"
                >
                  Email</label
                >
                <div class="col-md-6">
                  <input
                    type="email"
                    :class="`form-control ${errors.email ? 'is-invalid' : ''}`"
                    id="email"
                    v-model="form.email"
                  />
                  <div class="invalid-feedback" v-if="errors.email">
                    {{ errors.email[0] }}
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label
                  for="password"
                  class="col-md-4 col-form-label text-md-right"
                >
                  Senha</label
                >
                <div class="col-md-6">
                  <input
                    type="password"
                    :class="`form-control ${
                      errors.password ? 'is-invalid' : ''
                    }`"
                    id="password"
                    v-model="form.password"
                  />
                  <div class="invalid-feedback" v-if="errors.password">
                    {{ errors.password[0] }}
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label
                  for="password_confirmation"
                  class="col-md-4 col-form-label text-md-right"
                >
                  Confirmar senha</label
                >
                <div class="col-md-6">
                  <input
                    type="password"
                    :class="`form-control ${
                      errors.password_confirmation ? 'is-invalid' : ''
                    }`"
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                  />
                  <div
                    class="invalid-feedback"
                    v-if="errors.password_confirmation"
                  >
                    {{ errors.password_confirmation[0] }}
                  </div>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button
                    @click.prevent="resgisterUser"
                    class="btn btn-primary btn-sm"
                  >
                    Registrar
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import api from "../../api/auth";
export default {
  name: "Register",
  data() {
    return {
      form: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      errors: [],
    };
  },
  methods: {
    resgisterUser() {
      api
        .register(this.form)
        .then((r) => {
          this.$toastr.s("Cadastrado com sucesso!");
          this.login();
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
    async login() {
      await new Promise((t) => setTimeout(t, 2000));
      window.location.href = "/#/";
      api
        .login({ email: this.form.email, password: this.form.password })
        .then(() => {
          window.location.href = "/spa/";
        })
        .catch((error) => {
          window.location.href = "/spa/";
        });
    },
  },
};
</script>
