//Auth Components
import Login from './components/Auth/Login.vue'
import Logout from './components/Auth/Logout.vue'

//General Components
import NotFound from './components/General/NotFound.vue'

//Landing Components
import Home from './components/Pages/Home.vue'

//Export routes based on domain used
const host = window.location.host.toUpperCase()

const routes = () => {
    return [
        {path: '/', name: 'home', component: Home},
        {path: '/login', name: 'landing.login', component: Login},
        {path: '/logout', name: 'landing.logout', component: Logout},
        {path: '*', component: NotFound}
    ]
}

export default routes()
