<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-body">
            <ClienteCreate
              :pageClienteCreate="pageClienteCreate"
              ref="createCliente"
            ></ClienteCreate>
            <div v-if="!pageClienteCreate">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <p><strong>Nome: </strong>{{ cliente.nome }}</p>
                  <p><strong>CPF: </strong>{{ cliente.cpf }}</p>
                  <p><strong>Email: </strong>{{ cliente.email }}</p>
                </div>
                <div class="col-md-4 mb-3">
                  <h4 style="font-weight: bold">
                    <p>meu saldo</p>
                    {{ formatNumber(cliente.saldo, 2, "R$ ") }}
                  </h4>
                </div>
              </div>
              <hr style="border: 0; border-top: 1px solid black" />
              <div class="card">
                <div class="card-body py-2">
                  <div class="row">
                    <div class="col-md-4 mb-3">
                      <div style="max-width: 200px">
                        <img :src="produto.foto" width="100%" />
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <h5 class="card-title font-weight-bold">
                        {{ produto.nome }}
                      </h5>
                      <p class="card-text text-justify">
                        {{ produto.decricao }}
                      </p>

                      <h4 style="font-weight: bold">
                        {{ formatNumber(produto.valor, 2, "R$ ") }}
                      </h4>

                      <div class="form-group row">
                        <label for="01" class="col-md-3 col-form-label"
                          >Quantidade</label
                        >
                        <div class="col-md-3">
                          <input
                            type="number"
                            class="form-control"
                            id="01"
                            v-model="quantidade"
                            min="1"
                            :max="produto.quantidade"
                            @change="onchange(quantidade)"
                          />
                        </div>
                      </div>
                      <h4 style="font-weight: bold; color: red">
                        Total:
                        {{ formatNumber(total, 2, "R$ ") }}
                      </h4>
                      <button
                        v-if="produto.quantidade > 0"
                        @click.prevent="createOrder"
                        class="btn btn-success"
                      >
                        FINALIZAR COMPRA
                      </button>
                      <button v-else class="btn btn-danger">SEM ESTOQUE</button>
                    </div>
                  </div>
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
import api from "../../api/user";
import ClienteCreate from "./components/ClienteCreate";
export default {
  name: "Shopcart",
  components: { ClienteCreate },
  data() {
    return {
      pageClienteCreate: "",
      quantidade: 1,
      cliente: "",
      produto: "",
      total: "",
    };
  },
  mounted() {
    this.getCliente();
    this.getProduto();
  },

  methods: {
    getProduto() {
      const id = this.$route.params.produtoId;
      api
        .findOneProduto(id)
        .then((r) => {
          this.produto = r.data;
          this.total = r.data.valor;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    createOrder() {
      api
        .createOrder({
          produto_id: this.produto.id,
          quantidade: this.quantidade,
        })
        .then((r) => {
          this.$toastr.s("Compra efetuada com êxito!");
          this.success();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.$toastr.e(`${error.response.data.message}`);
          }
        });
    },
    getCliente() {
      api
        .findOneCliente()
        .then((r) => {
          if (r.data.id) {
            this.pageClienteCreate = null;
            this.cliente = r.data;
          } else {
            this.pageClienteCreate = true;
            this.$refs.createCliente.getUser();
          }
        })
        .catch((error) => {
          this.$toastr.e("Ocorreu um erro tente novamente!");
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
    onchange(number) {
      this.total = this.produto.valor * number;
    },
    async success() {
      await new Promise((t) => setTimeout(t, 4000));
      window.location.href = "/spa/";
    },
  },
};
</script>
