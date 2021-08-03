import auth from './api/auth';

//Auth Components
import Login from './components/Auth/Login.vue'
import Logout from './components/Auth/Logout.vue'

//General Components
import NotFound from './components/General/NotFound.vue'

//Landing Components
import Home from './components/Pages/Home.vue'
import VueRouter from "vue-router";

const routes = [
    {path: '/', name: 'home', component: Home, meta: {access: 'auth'}},
    {path: '/login', name: 'landing.login', component: Login, meta: {access: 'guest'}},
    {path: '/logout', name: 'landing.logout', component: Logout, meta: {access: 'auth'}},
    {path: '*', component: NotFound}
]

//Router configuration
const router = new VueRouter({
    mode: 'history',
    routes,
})

// GOOD
router.beforeEach((to, from, next) => {
    if (to.meta && to.meta.access) {
        if (to.meta.access === 'guest' && auth.authenticated()) {
            next({path: '/'});
        } else if (to.meta.access === 'auth' && !auth.authenticated()) {
            next({path: '/login'});
        }

        next();
    }
})

export default router;
