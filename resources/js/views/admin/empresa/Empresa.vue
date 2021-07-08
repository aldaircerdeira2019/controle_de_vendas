<template>
  <div>
    <div class="container">
      <div class="row">
        <Menu />
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title text-center">
                EMPRESAS
                <button @click.prevent="enviarCreate()" class="btn btn-primary btn-sm float-right">Novo</button>
              </h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">CNPJ</th>
                      <th scope="col">Nome</th>
                      <th scope="col">Cidade</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(empresa, index) in empresas" :key="empresa.id">
                      <th scope="row">{{ index + 1 }}</th>
                      <td>{{ empresa.cnpj }}</td>
                      <td>{{ empresa.nome }}</td>
                      <td>{{ empresa.cidade }}</td>
                      <td>{{ empresa.uf }}</td>
                      <td>
                        <div
                          class="btn-group"
                          role="group"
                          aria-label="Basic example"
                        >
                          <button class="btn btn-primary btn-sm">editar</button>
                          <button class="btn btn-danger btn-sm">excluir</button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div v-if="loading" class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <CreateEmpresa ref="create"></CreateEmpresa>
  </div>
</template>

<script>
import Menu from "../components/Menu";
import api from "../../../api/admin";
import CreateEmpresa from './components/CreateEmpresa';
export default {
  name: "Empresa",
  components: { Menu, CreateEmpresa},
  data() {
    return {
      loading: false,
      empresas: {},
    };
  },
  mounted() {
    this.getEmpresa();
  },

  methods: {
    getEmpresa() {
      this.loading = true;
      api
        .getAllEmpresa()
        .then((r) => {
          this.empresas = r.data;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    enviarCreate () {
      this.$refs.create.modalPost();
    },
  },
};
</script>
