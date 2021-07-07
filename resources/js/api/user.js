import axios from "axios";

const rota = 'http://localhost:8080/api/';

let api = {
  findOneCliente() {
    return axios.get(rota + "usuario/findOneCliente");
  },
  findUser() {
    return axios.get(rota + "usuario/findUser");
  },

  createCliente(params) {
    return axios.post(rota + "usuario/cliente", params);
  },

  findOneProduto(id) {
    return axios.get(rota + 'usuario/findOneProduto/' + id);
  },
  createOrder(params) {
    return axios.post(rota + 'usuario/createOrder', params);
  },
  findAllOrder(id) {
    return axios.get(rota + 'usuario/order/' + id);
  },

};

export default api;
