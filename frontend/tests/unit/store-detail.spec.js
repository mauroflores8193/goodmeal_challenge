import { createLocalVue, mount } from '@vue/test-utils'
import VueRouter from 'vue-router'
import StoreDetail from '@/components/pages/StoreDetail.vue'
import flushPromises from 'flush-promises'
import axios from 'axios'
import store from './../mocks/store.json'

jest.mock('axios')

const localVue = createLocalVue()
localVue.use(VueRouter)
const router = new VueRouter()
test('increments value on click', async () => {
  const mockRoute = {
    params: {
      id: 1
    }
  }
  axios.get.mockResolvedValue({ data: store });
  const tree = mount(StoreDetail, {
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
