<template>
  <div v-if="pageClienteCreate">
    <form>
      <div class="form-group row">
        <label for="cpf" class="col-md-4 col-form-label text-md-right">
          Cpf</label
        >
        <div class="col-md-6">
          <the-mask
            type="text"
            :class="`form-control ${errors.cpf ? 'is-invalid' : ''}`"
            id="cpf"
            :mask="'###.###.###-##'"
            :masked="true"
            v-model="form.cpf"
            autofocus
          />
          <div class="invalid-feedback" v-if="errors.cpf">
            {{ errors.cpf[0] }}
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label for="nome" class="col-md-4 col-form-label text-md-right">
          Nome</label
        >
        <div class="col-md-6">
          <input
            type="text"
            :class="`form-control ${errors.nome ? 'is-invalid' : ''}`"
            id="nome"
            v-model="form.nome"
            autofocus
          />
          <div class="invalid-feedback" v-if="errors.nome">
            {{ errors.nome[0] }}
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">
          Email</label
        >
        <div class="col-md-6">
          <input
            type="email"
            :class="`form-control ${errors.email ? 'is-invalid' : ''}`"
            id="email"
            v-model="form.email"
            value="sdfs"
          />
          <div class="invalid-feedback" v-if="errors.email">
            {{ errors.email[0] }}
          </div>
        </div>
      </div>

      <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
          <button @click.prevent="createCliente" class="btn btn-primary btn-sm">
            salvar
          </button>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
import api from "../../../api/user";
import { TheMask } from "vue-the-mask";
export default {
  name: "ClienteCreate",
  components: { TheMask },
  props: ["pageClienteCreate"],
  data() {
    return {
      form: {
        nome: "",
        cpf: "",
        email: "",
      },
      errors: [],
    };
  },
  methods: {
    getUser() {
      api
        .findUser()
        .then((r) => {
          this.form.nome = r.data.name;
          this.form.email = r.data.email;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    createCliente() {
      api
        .createCliente(this.form)
        .then((r) => {
           this.$parent.getCliente();
        })
        .catch((error) => {
          if (error.response.data.errors) {
            this.errors = error.response.data.errors;
          } else {
            this.$toastr.e(`${error.response.data.message}`);
          }
        });
    },
  },
};
</script>
