import http from "./http";

const urlBase = 'http://localhost:8000/api/orders'
const get = id => http.get(`${urlBase}/${id}`)
const getAll = () => http.get(urlBase)

export default { get, getAll }