import axios from "axios";

const rota = 'http://localhost:8080/api/';

let api = {
  login(params) {
    return axios.post(rota + "login", params);
  },
  register(params) {
    return axios.post(rota + "register", params);
  },
  authenticated() {
    return axios.get(rota + "authenticated");
  },
  logout() {
    return axios.post(rota + "logout");
  },
};

export default api;
