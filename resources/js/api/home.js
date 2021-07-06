import axios from "axios";

const rota = 'http://localhost:8080/api/';

let api = {
  index(params) {
    return axios.get(rota + "home", { params });
  },
  getAllEmpresas() {
    return axios.get(rota + "empresas");
  },

};

export default api;
