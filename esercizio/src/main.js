import { registerPlugins } from '@/plugins'
import { createRouter, createWebHistory } from 'vue-router'
import App from './App.vue'
import { createApp, ref } from 'vue'
import 'unfonts.css'
import axios from 'axios'
import Login from '@/login/Login.vue'
import Home from "@/home/Home.vue"
import View from '@/view/View.vue'
import Update from '@/update/Update.vue'
import Create from '@/create/Create.vue'
import Account from '@/account/account.vue'


const router  = createRouter({
        history: createWebHistory(),
        routes: [
            {path: '/Login', name: "Login", component: Login},
            {path: '/', name: "Home", component: Home},
            {path: '/View', name: "View", component: View},
            {path: '/Update', name: "Update", component: Update},
            {path: '/Create', name: "Create", component: Create},
            {path: '/Account', name: "Account", component: Account}
        ]
})

let rotte = ["/Login","/","/View","/Update","/Create","/Account"];

const accesso = ref(false);
const admin = ref(false);
const token = ref('');


if (localStorage.getItem('accesso') && accesso.value === false) {
    accesso.value = true;
    token.value = localStorage.getItem('accesso');
    if (token.value.length === 10 && token.value.includes("9") && token.value.includes("r")){
        admin.value = true;
    } else {
        router.removeRoute("Create");
        router.removeRoute("Update");
        rotte = rotte.filter(path => path !== "/Update" && path !== "/Create");
    }
}

router.beforeEach((to, from, next) => {
    
    if (!accesso.value && to.fullPath !== "/Login" && token !== '') {
        console.log("Accesso non eseguito");
        return next("/Login");
    } 
     
    if (accesso.value && to.fullPath === "/Login") {
        console.log("Login già effettuato");
        return next("/");
    }
    
    if (!rotte.includes(to.path)) {
        console.log(`La pagina ${to.fullPath} è inesistente o inaccessibile`);
        return next("/");
    }
    console.log(`Reindirizzamento da ${from.fullPath} a ${to.fullPath}`);
    return next();
});


export default {
    id: 0,
    nome: "",
    eta: 0,
    email: "",
    admin,
    accesso,
    router,
    login: function(){
        accesso.value = true;
        router.removeRoute("Login");
        rotte = rotte.filter(path => path !== "/Login");
        if (token.value !== '') {
            token.value = document.cookie;
            if (token.value.length === 10 && token.value.includes("9") && token.value.includes("r")){
                admin.value = true;
                console.log(this)
            } else {
                router.removeRoute("Create");
                router.removeRoute("Update");
                rotte = rotte.filter(path => path !== "/Update" && path !== "/Create");
            }
        }
        router.replace("/");
        location.reload();
    },
    logout: function(){
        axios({
            method: 'post',
            url: 'http://localhost:8888/Logout',
        })
        admin.value = false;
        accesso.value = false;
        localStorage.removeItem("accesso");
        router.addRoute({path: '/Login', name: "Login", component: Login});
        rotte.push("/Login");
        router.replace("/Login");
    }
}
const app = createApp(App)

registerPlugins(app)

app.use(router).mount('#app')