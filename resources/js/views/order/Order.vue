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
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Produto</th>
                          <th scope="col">Empresa</th>
                          <th scope="col">Valor unitário</th>
                          <th scope="col">qtd</th>
                          <th scope="col">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(order, index) in orders" :key="order.id">
                          <th scope="row">{{ index + 1 }}</th>
                          <td>{{ order.produto.nome }}</td>
                          <td>{{ order.empresa.nome }}</td>
                          <td>
                            {{ formatNumber(order.valor_unitatio, 2, "R$ ") }}
                          </td>
                          <td>{{ order.quantidade }}</td>
                          <td>
                            {{ formatNumber(order.valor_total, 2, "R$ ") }}
                          </td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="5">Total</td>
                          <td class="center-align">
                            {{
                              formatNumber(dinamic_sum("valor_total"), 2, "R$ ")
                            }}
                          </td>
                        </tr>
                      </tfoot>
                    </table>
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
  name: "Order",
  components: { ClienteCreate },
  data() {
    return {
      pageClienteCreate: null,
      cliente: "",
      orders: [],
    };
  },
  mounted() {
    this.getCliente();
  },

  methods: {
    getCliente() {
      api
        .findOneCliente()
        .then((r) => {
          if (r.data.id) {
            this.pageClienteCreate = null;
            this.cliente = r.data;
            this.getOrder(r.data.id);
          } else {
            this.pageClienteCreate = true;
            this.$refs.createCliente.getUser();
          }
        })
        .catch((error) => {
          this.$toastr.e("Ocorreu um erro tente novamente!");
        });
    },
    getOrder(id) {
      api
        .findAllOrder(id)
        .then((r) => {
          this.orders = r.data;
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
    dinamic_sum(attribute) {
      return this.orders.reduce(function (total, ele) {
        let number = ele[attribute];
        return total + Number(number);
      }, 0);
    },
  },
};
</script>
