import axios from "axios";

const rota = 'http://localhost:8080/api/';

let api = {
  getAllEmpresa() {
    return axios.get(rota + "admin/empresa");
  },

  EmpresaStore(params) {
    return axios.post(rota + "admin/empresa", params);
  },

  EmpresaUpdate(params) {
    return axios.put(rota + "admin/empresa/" + params.id , params);
  },

  EmpresaDelete(id) {
    return axios.delete(rota + "admin/empresa/" + id);
  },

  getCep(cep) {
    return axios.get(`https://viacep.com.br/ws/${cep}/json/`);
  },
};

export default api;
