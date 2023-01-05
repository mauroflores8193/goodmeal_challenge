import { createLocalVue, mount } from '@vue/test-utils'
import VueRouter from 'vue-router'
import Home from '@/components/pages/Home.vue'
import flushPromises from 'flush-promises'
import axios from 'axios'
import storeList from './../mocks/storeList.json'

jest.mock('axios')

const localVue = createLocalVue()
localVue.use(VueRouter)
const router = new VueRouter()
test('increments value on click', async () => {
  axios.get.mockResolvedValue({ data: storeList });
  const tree = mount(Home, { localVue, router })
  await flushPromises();
  expect(tree).toMatchSnapshot();
})
