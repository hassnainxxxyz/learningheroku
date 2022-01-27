
const state = {
    user: {},
    permissions: [],



};

const getters = {
    getUser(state) {

        return state.user;
    },



};

const mutations = {
   setUser() {
       if(localStorage.getItem('user')) {
           state.user = JSON.parse(localStorage.getItem('user'));
       }
   },



};

const actions = {







};


export default {state, getters, mutations, actions};


