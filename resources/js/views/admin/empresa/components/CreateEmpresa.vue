<template>
  <div>
    <div
      class="modal fade"
      id="ModalDica"
      tabindex="-1"
      role="dialog"
      aria-labelledby="ModalDicaLabel"
      aria-hidden="true"
      data-backdrop="static"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header"><h5>Nova Empresa</h5></div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="01" class="col-form-label">Nome da Empresa</label>
                <input
                  type="text"
                  v-model="empresa.nome"
                  :class="`form-control ${errors.nome ? 'is-invalid' : ''}`"
                  id="01"
                />
                <div class="invalid-feedback" v-if="errors.nome">
                  {{ errors.nome[0] }}
                </div>
              </div>

              <div class="form-group">
                <label for="02" class="col-form-label">CNPJ</label>
                <the-mask
                  type="text"
                  :mask="'##.###.###/####-##'"
                  :masked="true"
                  v-model="empresa.cnpj"
                  :class="`form-control ${errors.cnpj ? 'is-invalid' : ''}`"
                  id="02"
                />
                <div class="invalid-feedback" v-if="errors.cnpj">
                  {{ errors.cnpj[0] }}
                </div>
              </div>

              <div class="form-group">
                <label for="03" class="col-form-label">Razão Social</label>
                <input
                  type="text"
                  v-model="empresa.razao_social"
                  :class="`form-control ${
                    errors.razao_social ? 'is-invalid' : ''
                  }`"
                  id="03"
                />
                <div class="invalid-feedback" v-if="errors.razao_social">
                  {{ errors.razao_social[0] }}
                </div>
              </div>

              <div class="form-group">
                <label for="04" class="col-form-label">CEP</label>
                <div class="input-group">
                  <the-mask
                    :mask="'#####-###'"
                    :masked="true"
                    type="text"
                    v-model="empresa.cep"
                    :class="`form-control ${errors.cep ? 'is-invalid' : ''}`"
                    id="04"
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
                <label for="05" class="col-form-label">Rua</label>
                <input
                  type="text"
                  v-model="empresa.rua"
                  :class="`form-control ${errors.rua ? 'is-invalid' : ''}`"
                  id="05"
                />
                <div class="invalid-feedback" v-if="errors.rua">
                  {{ errors.rua[0] }}
                </div>
              </div>

              <div class="form-group">
                <label for="06" class="col-form-label">Bairro</label>
                <input
                  type="text"
                  v-model="empresa.bairro"
                  :class="`form-control ${errors.bairro ? 'is-invalid' : ''}`"
                  id="06"
                />
                <div class="invalid-feedback" v-if="errors.bairro">
                  {{ errors.bairro[0] }}
                </div>
              </div>

              <div class="form-group">
                <label for="07" class="col-form-label">Complemento</label>
                <input
                  type="text"
                  v-model="empresa.complemento"
                  :class="`form-control ${
                    errors.complemento ? 'is-invalid' : ''
                  }`"
                  id="07"
                />
                <div class="invalid-feedback" v-if="errors.complemento">
                  {{ errors.complemento[0] }}
                </div>
              </div>

              <div class="form-group">
                <label for="08" class="col-form-label">Cidade</label>
                <input
                  type="text"
                  v-model="empresa.cidade"
                  :class="`form-control ${errors.cidade ? 'is-invalid' : ''}`"
                  id="08"
                />
                <div class="invalid-feedback" v-if="errors.cidade">
                  {{ errors.cidade[0] }}
                </div>
              </div>

              <div class="form-group">
                <label for="09" class="col-form-label">Estado</label>
                <the-mask
                  type="text"
                  :mask="'AA'"
                  :masked="true"
                  v-model="empresa.uf"
                  :class="`form-control ${errors.uf ? 'is-invalid' : ''}`"
                  id="09"
                />
                <div class="invalid-feedback" v-if="errors.uf">
                  {{ errors.uf[0] }}
                </div>
              </div>

              <div class="form-group">
                <label for="10" class="col-form-label">Email</label>
                <input
                  type="text"
                  v-model="empresa.email"
                  :class="`form-control ${errors.email ? 'is-invalid' : ''}`"
                  id="10"
                />
                <div class="invalid-feedback" v-if="errors.email">
                  {{ errors.email[0] }}
                </div>
              </div>

              <div class="form-group">
                <label for="11" class="col-form-label">Confirma Senha</label>
                <input
                  type="password"
                  v-model="empresa.password"
                  :class="`form-control ${errors.password ? 'is-invalid' : ''}`"
                  id="11"
                />
                <div class="invalid-feedback" v-if="errors.password">
                  {{ errors.password[0] }}
                </div>
              </div>

              <div class="form-group">
                <label for="12" class="col-form-label">Confirma Senha</label>
                <input
                  type="password"
                  v-model="empresa.password_confirmation"
                  :class="`form-control ${errors.password_confirmation ? 'is-invalid' : ''}`"
                  id="12"
                />
                <div class="invalid-feedback" v-if="errors.password_confirmation">
                  {{ errors.password_confirmation[0] }}
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
                @click.prevent="EmpresaStora()"
              >
                Cadastrar
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
      empresa: {
        nome: "",
        cnpj: "",
        cep: "",
        razao_social: "",
        rua: "",
        bairro: "",
        complemento: "",
        cidade: "",
        uf: "",
        email: '',
        password: '',
        password_confirmation: "",
      },
      errors: {},
    };
  },
  methods: {
    modalPost() {
      this.errors = {};
      $("#ModalDica").modal("show");
    },
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
    EmpresaStora() {

      api
        .EmpresaStore(this.empresa)
        .then((r) => {
          this.empresa = {};
          this.$toastr.s("Cadastrado com sucesso!");
          $("#ModalDica").modal("hide");
          this.$parent.getEmpresa();
        })
        .catch((error) => {
           if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
          this.$toastr.e("Ocorreu um erro.");
        });
    },
  },
};
</script>
