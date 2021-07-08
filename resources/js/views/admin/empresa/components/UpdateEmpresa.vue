<template>
  <div>
    <div
      class="modal fade"
      id="ModalUpdate"
      tabindex="-1"
      role="dialog"
      aria-labelledby="ModalUpdateLabel"
      aria-hidden="true"
      data-backdrop="static"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header"><h5>Atualizar dados da Empresa</h5></div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="up-01" class="col-form-label"
                  >Nome da Empresa</label
                >
                <input
                  type="text"
                  v-model="empresa.nome"
                  :class="`form-control ${errors.nome ? 'is-invalid' : ''}`"
                  id="up-01"
                />
                <div class="invalid-feedback" v-if="errors.nome">
                  {{ errors.nome[0] }}
                </div>
              </div>

              <div class="form-group">
                <label for="up-02" class="col-form-label">CNPJ</label>
                <the-mask
                  type="text"
                  :mask="'##.###.###/####-##'"
                  :masked="true"
                  v-model="empresa.cnpj"
                  :class="`form-control ${errors.cnpj ? 'is-invalid' : ''}`"
                  id="up-02"
                />
                <div class="invalid-feedback" v-if="errors.cnpj">
                  {{ errors.cnpj[0] }}
                </div>
              </div>

              <div class="form-group">
                <label for="up-03" class="col-form-label">Razão Social</label>
                <input
                  type="text"
                  v-model="empresa.razao_social"
                  :class="`form-control ${
                    errors.razao_social ? 'is-invalid' : ''
                  }`"
                  id="up-03"
                />
                <div class="invalid-feedback" v-if="errors.razao_social">
                  {{ errors.razao_social[0] }}
                </div>
              </div>

              <div class="form-group">
                <label for="up-04" class="col-form-label">CEP</label>
                <div class="input-group">
                  <the-mask
                    :mask="'#####-###'"
                    :masked="true"
                    type="text"
                    v-model="empresa.cep"
                    :class="`form-control ${errors.cep ? 'is-invalid' : ''}`"
                    id="up-04"
                  />
                  <div class="invalid-feedback" v-if="errors.cep">
                    {{ errors.cep[0] }}
                  </div>
                  <div class="input-group-append">
                    <button
                      @click.prevent="getCep(empresa.cep)"
                      class="input-group-text"
                    >
                      buscar
                    </button>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="up-05" class="col-form-label">Rua</label>
                <input
                  type="text"
                  v-model="empresa.rua"
                  :class="`form-control ${errors.rua ? 'is-invalid' : ''}`"
                  id="up-05"
                />
                <div class="invalid-feedback" v-if="errors.rua">
                  {{ errors.rua[0] }}
                </div>
              </div>

              <div class="form-group">
                <label for="up-06" class="col-form-label">Bairro</label>
                <input
                  type="text"
                  v-model="empresa.bairro"
                  :class="`form-control ${errors.bairro ? 'is-invalid' : ''}`"
                  id="up-06"
                />
                <div class="invalid-feedback" v-if="errors.bairro">
                  {{ errors.bairro[0] }}
                </div>
              </div>

              <div class="form-group">
                <label for="up-07" class="col-form-label">Complemento</label>
                <input
                  type="text"
                  v-model="empresa.complemento"
                  :class="`form-control ${
                    errors.complemento ? 'is-invalid' : ''
                  }`"
                  id="up-07"
                />
                <div class="invalid-feedback" v-if="errors.complemento">
                  {{ errors.complemento[0] }}
                </div>
              </div>

              <div class="form-group">
                <label for="up-08" class="col-form-label">Cidade</label>
                <input
                  type="text"
                  v-model="empresa.cidade"
                  :class="`form-control ${errors.cidade ? 'is-invalid' : ''}`"
                  id="up-08"
                />
                <div class="invalid-feedback" v-if="errors.cidade">
                  {{ errors.cidade[0] }}
                </div>
              </div>

              <div class="form-group">
                <label for="up-09" class="col-form-label">Estado</label>
                <the-mask
                  type="text"
                  :mask="'AA'"
                  :masked="true"
                  v-model="empresa.uf"
                  :class="`form-control ${errors.uf ? 'is-invalid' : ''}`"
                  id="up-09"
                />
                <div class="invalid-feedback" v-if="errors.uf">
                  {{ errors.uf[0] }}
                </div>
              </div>

              <button
                type="button"
                class="btn btn-danger btn-sm"
                data-dismiss="modal"
              >
                Cancelar
              </button>
              <button
                type="button"
                class="btn btn-success btn-sm float-right"
                @click.prevent="update()"
              >
                salvar
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { TheMask } from "vue-the-mask";
import api from "../../../../api/admin";
export default {
  components: { TheMask },
  data() {
    return {
      empresa: {},
      errors: {},
    };
  },
  methods: {
    getCep(string) {
      if (string.length < 9) {
        this.$toastr.e("CEP imcompleto");
      } else {
        const cep = string.replace(/[^0-9]/g, "");
        api
          .getCep(cep)
          .then((r) => {
            this.empresa.rua = r.data.logradouro;
            this.empresa.bairro = r.data.bairro;
            this.empresa.complemento = r.data.complemento;
            this.empresa.cidade = r.data.localidade;
            this.empresa.uf = r.data.uf;
          })
          .catch(() => {
            this.$toastr.e(
              "endereço não encontrado, informe o endereço manualmento."
            );
          });
      }
    },
    update() {
      api
        .EmpresaUpdate(this.empresa)
        .then((r) => {
          this.$toastr.s("Atualizado com sucesso!");
          $("#ModalUpdate").modal("hide");
          this.$parent.getEmpresa();
        })
        .catch((error) => {
          console.log(error.response.data);
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
          this.$toastr.e("Ocorreu um erro.");
        });
    },
    modalPut(empresa) {
      this.empresa = empresa;
      this.errors = {};
      $("#ModalUpdate").modal("show");
    },
  },
};
</script>
