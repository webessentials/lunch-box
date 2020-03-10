import Login from '../components/Login'
import HomePage from '../components/HomePage'
import Registeration from '../components/Registration'
import Ordering from '../components/Ordering'
import Dashboard from '../components/Dashboard'
import FoodList from '../components/FoodList'
import OrderList from '../components/OrderList'
import AddFood from '../components/AddFood'

const routes = [
    { path: '/', component: HomePage  },
    { path: '/login', component: Login },
    { path: '/registration', component: Registeration },
    { path: '/dashboard', component: Dashboard },
    { path: '/foodlist', component: FoodList },
    { path: '/orderlist', component: OrderList },
    { path: '/addfood', component: AddFood },
    { path: '/ordering/:id', component: Ordering }
];

export default routes
