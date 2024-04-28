
import Menu from './components/Menu.vue';
import Menuuserens from './components/menuuserens.vue';
import Listeetudiant from './components/Etudiant/Listeetudiant.vue';
import Addetudiant from './components/Etudiant/Addetudiant.vue';
import Addcour from './components/Cour/Addcour.vue';
import Editetudiant from './components/Etudiant/Editetudiant.vue';
import Listecour from './components/Cour/Listecour.vue';
import Listeenseignant from './components/Enseignant/Listeenseignant.vue';
import Addenseignant from './components/Enseignant/Addenseignant.vue';
import Addgroupe from './components/Groupe/Addgroupe.vue';
import Editgroupe from './components/Groupe/Editgroupe.vue';
import Listegroupe from './components/Groupe/Listegroupe.vue';
import Adddiplome from './components/Diplome/Adddiplome.vue';
import Editdiplome from './components/Diplome/Editdiplome.vue';
import Listediplome from './components/Diplome/Listediplome.vue';
import Login from './components/authentification/login.vue';
import Loginuserens from './components/authentificationens/loginuserens.vue';
import Register from './components/authentification/register.vue';
import Registeruserens from './components/authentificationens/registeruserens.vue';
import Welc from './components/welc.vue';
export const routes = [


    {
        name: 'menu',
        path: '/menu',
        component: Menu,
       
    },
    {
        name: 'welc',
        path: '/',
        component: Welc,
       
    },
    {
        name: 'menuuserens',
        path: '/menuuserens',
        component: Menuuserens,
       
    },
    

    {
        name: 'Addetudiant',
        path: '/addetudiant',
        component: Addetudiant
    },
    {
        name: 'Addcour',
        path: '/addcour',
        component: Addcour
    },
    {
        name: 'Listecour',
        path: '/listecour',
        component: Listecour,
        meta:{isAuth:true}
    },
    {
        name: 'Editetudiant',
        path: '/editetudiant',
        component: Editetudiant
    },


    {
        name: "login",
        path: "/login",
        component: Login
    },
    {
        name: "loginuserens",
        path: "/loginuserens",
        component: Loginuserens
    },
    
    {
        name: "register",
        path: "/register",
        component: Register
    },
    {
        name: "registeruserens",
        path: "/registeruserens",
        component: Registeruserens
    },
   
    {
        name: 'Addgroupe',
        path: '/addgroupe',
        component: Addgroupe
    },
    {
        name: 'Editgroupe',
        path: '/editgroupe',
        component: Editgroupe
    },
    {
        name: 'Listegroupe',
        path: '/listegroupe',
        component: Listegroupe,
        meta:{isAuth:true}
    },

    {
        name: 'Adddiplome',
        path: '/adddiplome',
        component: Adddiplome
    },
    {
        name: 'Editdiplome',
        path: '/editdiplome',
        component: Editdiplome
    },
    {
        name: 'Listediplome',
        path: '/listediplome',
        component: Listediplome,
        meta:{isAuth:true}
    },


    {
        name: 'Addenseignant',
        path: '/addenseignant',
        component: Addenseignant
    },

    {
        name: 'Listeenseignant',
        path: '/listeenseignant',
        component: Listeenseignant,
        meta:{isAuth:true}
    },
    {
        name: 'Listeetudiant',
        path: '/listeetudiant',
        component: Listeetudiant,
        meta:{isAuth:true}
    }

];