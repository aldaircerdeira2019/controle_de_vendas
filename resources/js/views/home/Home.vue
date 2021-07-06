<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <form class="needs-validation" novalidate>
              <div class="form-row">
                <div class="form-group col-md-6 mb-3">
                  <label for="01">Nome do Produto</label>
                  <input
                    v-model="params.search"
                    type="text"
                    class="form-control"
                    id="01"
                  />
                </div>
                <div class="form-group col-md-6 mb-3">
                  <label for="02">Empresa</label>
                  <select
                    v-model="params.empresa_id"
                    class="custom-select"
                    id="02"
                  >
                    <option selected disabled value="">...</option>
                    <option
                      v-for="empresa in empresas"
                      :key="empresa.id"
                      :value="empresa.id"
                    >
                      {{ empresa.nome }}
                    </option>
                  </select>
                </div>
              </div>
              <button
                @click.prevent="getProdutos"
                class="btn btn-primary btn-sm"
              >
                Pesquisar
              </button>
            </form>
            <div class="py-3">
              <div class="card">
                <div class="card-body">
                  <div v-for="produto in produtos.data" :key="produto.id">
                    <div class="row">
                      <div class="col-md-3 mb-3">
                        <div style="max-width: 100px">
                          <img :src="produto.foto" width="100%" />
                        </div>
                      </div>
                      <div class="col-md-8 mb-3">
                        <h5 class="card-title font-weight-bold">
                          {{ produto.nome }}
                        </h5>
                        <p class="text-sm-left">
                          <strong>vendido por: </strong
                          >{{ produto.empresa.nome }}
                          <strong>| estoque: </strong>{{ produto.quantidade }}
                        </p>
                        <p class="card-text text-justify">
                          {{ produto.decricao }}
                        </p>
                        <div class="row">
                          <div class="col-md-4 mb-3">
                            <h4 style="font-weight: bold">
                              {{ formatNumber(produto.valor, 2, "R$ ") }}
                            </h4>
                          </div>
                          <div class="col-md-4 mb-3">
                            <button
                              v-if="produto.quantidade > 0"
                              class="btn btn-primary btn-sm"
                            >
                              comprar
                            </button>
                            <button
                              v-else
                              class="btn btn-danger btn-sm"
                              disabled
                            >
                              sem estoque
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr style="border: 0; border-top: 1px solid black" />
                  </div>
                  <pagination
                    :data="produtos"
                    @pagination-change-page="getProdutos"
                    :limit="2"
                  >
                    <span slot="prev-nav">&lt;</span>
                    <span slot="next-nav">&gt;</span>
                  </pagination>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import api from "../../api/home";
export default {
  name: "Home",
  data() {
    return {
      params: {
        empresa_id: "",
        search: "",
      },
      empresas: {},
      produtos: {},
      errors: [],
    };
  },
  mounted() {
    this.getEmpresas();
    this.getProdutos();
  },
  methods: {
    getEmpresas() {
      api
        .getAllEmpresas()
        .then((r) => {
          this.empresas = r.data;
        })
        .catch((error) => {});
    },
    getProdutos(page = 1) {
      this.params.page = page;
      api
        .index(this.params)
        .then((response) => {
          this.produtos = response.data;
        })
        .catch(() => {
          this.$toastr.e("Ocorreu um erro.");
        });
    },
    formatNumber(number, precision, start = "") {
      if (isNaN(parseFloat(number))) {
        return "--";
      }
      return (
        start +
        parseFloat(number)
          .toFixed(precision)
          .replace(/\d(?=(\d{3})+\.)/g, "$&!")
          .replace(".", ",")
          .replace(/!/g, ".")
      );
    },
  },
};
</script>
