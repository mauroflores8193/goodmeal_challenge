import { createLocalVue, mount } from '@vue/test-utils'
import VueRouter from 'vue-router'
import OrderDetail from '@/components/pages/OrderDetail.vue'
import flushPromises from 'flush-promises'
import axios from 'axios'
import order from './../mocks/order.json'

jest.mock('axios')

const localVue = createLocalVue()
localVue.use(VueRouter)
const router = new VueRouter()
test('OrderDetail.vue', async () => {
  const mockRoute = {
    params: {
      id: 1
    }
  }
  axios.get.mockResolvedValue({ data: order });
  const tree = mount(OrderDetail, {
    localVue, router, global: {      mocks: { $route: mockRoute }    }, computed: {
      emoticon() {
        return '🤯'
      },
      bgColor() {
        return 'bg-pink-400'
      }
    }
  })
  await flushPromises();
  expect(tree).toMatchSnapshot();
})
