import axios from "axios";

const rota = 'http://localhost:8080/api/';

let api = {
  getAllEmpresa() {
    return axios.get(rota + "admin/empresa");
  },

  EmpresaStore(params) {
    return axios.post(rota + "admin/empresa", params);
  },

  getCep(cep) {
    return axios.get(`https://viacep.com.br/ws/${cep}/json/`);
  },
};

export default api;
