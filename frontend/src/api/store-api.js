import axios from 'axios'

const urlBase = 'http://localhost:8000/api/stores'
const get = (id, params) => axios.get(`${urlBase}/${id}`, { params }).then(res => res.data)
const getAll = params => axios.get(`${urlBase}`, { params }).then(res => res.data)

export default { get, getAll }