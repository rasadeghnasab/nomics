//Auth Components
import AuthLayout from './components/Layouts/AuthLayout.vue'
import Register from './components/Auth/Register.vue'
import Login from './components/Auth/Login.vue'

//General Components
import NotFound from './components/General/NotFound.vue'

//Landing Components
import Home from './components/Pages/Home.vue'

//Export routes based on domain used
const host = window.location.host.toUpperCase()

const routes = () => {

    return [
        {path: '/', name: 'home', component: Home},
        {path: '/register', name: 'landing.register', component: Register},
        {path: '/login', name: 'landing.login', component: Login},
        {path: '*', component: NotFound}
    ]
}

export default routes()
