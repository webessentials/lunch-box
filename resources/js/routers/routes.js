import Foo from '../components/Foo'
import Bar from '../components/Bar'
import Login from '../components/Login'
import HomePage from '../components/HomePage'
import Registeration from '../components/Registration'
import Ordering from '../components/Ordering'
import Dashboard from '../components/Dashboard'
import FoodList from '../components/FoodList'

const routes = [
  { path: '/', redirect: '/login' },
  { path: '/foo', component: Foo },
  { path: '/bar', component: Bar },
  { path: '/login', component: Login },
  { path: '/home', component: HomePage },
  { path: '/registration', component: Registeration },
  { path: '/dashboard', component: Dashboard },
  { path: '/ordering', component: Ordering },
  { path: '/foodlist', component: FoodList }
]

export default routes
