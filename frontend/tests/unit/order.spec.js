import { createLocalVue, mount } from '@vue/test-utils'
import VueRouter from 'vue-router'
import Orders from '@/components/pages/Orders.vue'
import flushPromises from 'flush-promises'
import axios from 'axios'
import orderList from './../mocks/orderList.json'

jest.mock('axios')

const localVue = createLocalVue()
localVue.use(VueRouter)
const router = new VueRouter()
test('Orders.vue', async () => {
  axios.get.mockResolvedValue({ data: orderList });
  const tree = mount(Orders, { localVue, router })
  await flushPromises();
  expect(tree).toMatchSnapshot();
})
