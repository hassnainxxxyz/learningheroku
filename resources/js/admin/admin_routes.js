import Home from "../components/admin/Home";

import MainContent from "../components/admin/layouts/Maincontent";


import FourOfFour from "../components/admin/layouts/404";


import Contact from "../components/admin/layouts/Contact";



import Login from "../components/auth/Login";
import UnAuthorized from "../components/auth/UnAuthorized";



// ITEMS PAGE
import Item from "../components/pages/items/Index";








const routes = [
    {path: '/', component: Home, name: 'show.home',
        children: [


            {path: "", component: MainContent, name: 'home'},

            {path: "/items", component: Item, name: 'items'},











            {path: "contact", component: Contact, name: 'contact'},




        ],
        // beforeEnter(to, from, next) {
        //     if(!localStorage.getItem('token')) {
        //         next({name: 'login'});
        //     } else {
        //         next();
        //     }
        //
        // },


},
    // LOGIN AND REGISTER ROUTES
    {path: '/login', component: Login, name: 'login',
        beforeEnter(to, from, next) {
            if(localStorage.getItem('token')) {
                next({name: 'home'});
            } else {
                next();
            }

        },

    },






    {path: '/unauthorized', component: UnAuthorized, name: 'unauthorized'},
    {path: '*', component: FourOfFour, name: '404'},







];

export default routes;



