<template>
  <div
    class="modal fade"
    id="delModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="delModalLabel"
    aria-hidden="true"
    data-backdrop="static"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <h4>
            Deseja realmente excluir : <b>{{ empresa.nome }}.</b>
          </h4>
          <button
            type="button"
            class="btn btn-danger btn-sm"
            data-dismiss="modal"
          >
            Cancelar
          </button>
          <button
            type="button"
            class="btn btn-success btn-sm pull-right"
            @click.prevent="delEmpresa(empresa.id)"
          >
            Sim
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from "../../../../api/admin";
export default {
  data() {
    return {
      empresa: {},
    };
  },
  methods: {
    modalDel(empresa) {
      this.empresa = empresa;
      $("#delModal").modal("show");
    },
    delEmpresa(id) {
      api
        .EmpresaDelete(id)
        .then(() => {
          this.$toastr.s("Excluido com sucesso!");
          $("#delModal").modal("hide");
          this.$parent.getEmpresa();
        })
        .catch((error) => {
          this.$toastr.e("Ocorreu um erro.");
        });
    },
  },
};
</script>
