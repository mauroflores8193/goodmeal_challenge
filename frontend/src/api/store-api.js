import http from "./http";

const urlBase = 'http://localhost:8000/api/stores'
const get = id => http.get(`${urlBase}/${id}`)
const getAll = () => http.get(urlBase)

export default { get, getAll }