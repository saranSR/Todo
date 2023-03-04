
import {createWebHistory , createRouter} from 'vue-router'
import Home from './vue/components/Home.vue'
import Todo from './vue/components/Todo.vue'
import Register from './vue/components/Register.vue'

const routes=[
    {
        name:'Home',
        path:'/',
        component:Home,
        meta:{title:'Login'},
    },
    {
        name:'Register',
        path:'/register',
        component:Register,
        meta:{title:'Register'}
    },
    {
        name:'TODO',
        path:'/todos',
        component:Todo ,
        meta:{title:'List'}
    }

]

const router=createRouter({
    history:createWebHistory(),
    routes
})

router.beforeEach((toRoute, fromRoute, next) => {
    document.title = toRoute.meta.title+' | To Do App'
    next()
  })
export default router;