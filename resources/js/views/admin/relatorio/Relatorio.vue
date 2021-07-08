<template>
  <div>
    <div class="container">
      <div class="row">
        <Menu />
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title text-center">Relatorio de Vendas</h5>
            </div>
            <div class="card-body">
              <form class="needs-validation" novalidate>
                <div class="form-row">
                  <div class="form-group col-md-3 mb-3">
                    <label for="02">Empresa</label>
                    <select
                      v-model="params.empresa_id"
                      class="custom-select"
                      id="02"
                    >
                      <option selected :value="''">Todas</option>
                      <option
                        v-for="empresa in empresas"
                        :key="empresa.id"
                        :value="empresa.id"
                      >
                        {{ empresa.nome }}
                      </option>
                    </select>
                  </div>
                  <div class="form-group col-md-3 mb-3">
                    <label for="03">De </label>
                    <input
                      type="date"
                      v-model="params.data_inicio"
                      class="form-control"
                      id="03"
                    />
                  </div>
                  <div class="form-group col-md-3 mb-3">
                    <label for="04">Até </label>
                    <input
                      type="date"
                      v-model="params.data_final"
                      class="form-control"
                      id="04"
                    />
                  </div>
                </div>
                <button
                  @click.prevent="getRelatorio"
                  class="btn btn-primary btn-sm"
                >
                  Filtrar
                </button>
              </form>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Clinte</th>
                      <th scope="col">Empresa</th>
                      <th scope="col">Produto</th>
                      <th scope="col">Qtd</th>
                      <th scope="col">Data</th>
                      <th scope="col">Valor</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(relatorio, index) in relatorio"
                      :key="relatorio.id"
                    >
                      <td scope="row">{{ index + 1 }}</td>
                      <td>{{ relatorio.cliente.nome }}</td>
                      <td>{{ relatorio.empresa.nome }}</td>
                      <td>{{ relatorio.produto.nome }}</td>
                      <td>{{ relatorio.quantidade }}</td>
                      <td>
                        {{
                          new Date(relatorio.created_at)
                            | dateFormat("DD MMM YY")
                        }}
                      </td>
                      <td>{{ relatorio.valor_total }}</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr style="background-color: #A9A9A9">
                      <th colspan="5">Total</th>
                      <th colspan="2" class="center-align" style="color:red">
                        {{ formatNumber(dinamic_sum("valor_total"), 2, "R$ ") }}
                      </th>
                    </tr>
                  </tfoot>
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
  </div>
</template>

<script>
import Menu from "../components/Menu";
import api from "../../../api/admin";
export default {
  name: "Relatorio",
  components: { Menu },
  data() {
    return {
      loading: false,
      empresas: {},
      relatorio: [],
      params: {
        empresa_id: "",
        data_inicio: "",
        data_final: "",
      },
    };
  },
  mounted() {
    this.getEmpresa();
    this.getRelatorio();
  },

  methods: {
    getRelatorio() {
      this.loading = true;
      api
        .getRelatorio(this.params)
        .then((r) => {
          this.relatorio = r.data;
          this.loading = false;
        })
        .catch((error) => {});
    },
    getEmpresa() {
      api
        .getAllEmpresa()
        .then((r) => {
          this.empresas = r.data;
        })
        .catch((error) => {});
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
      return this.relatorio.reduce(function (total, ele) {
        let number = ele[attribute];
        return total + Number(number);
      }, 0);
    },
  },
};
</script>
