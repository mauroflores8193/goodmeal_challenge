import axios from 'axios'

const get = (url) => axios.get(url).then(res => res.data)

export default { get }