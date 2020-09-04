import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate"


Vue.use(Vuex)




export const store = new Vuex.Store({
        state : {
            token: null,
            cartCount : 0
        },
      
        getters : {
            token: (state) => {
                return state.token
            },

            is_logged_in: (state) => {
                return state.token != null
            },

            cartCount : (state) => {
                return state.cartCount
            }
        },
      
        mutations : {
            doRetrieveToken(state, data) {
                state.token = data
            },

            doDestroyToken(state, data = null) {
                state.token = data
            },
            
            updateCartCount(state, data){
                state.cartCount = data
            }
        },
      
        actions : {
            doRetrieveToken({commit}, data) {
                commit('doRetrieveToken', data)
            },

            doDestroyToken({commit}, data = null) {
                commit('doDestroyToken', data)
            },
            
            updateCartCount({commit}, data) {
                commit('updateCartCount', data)
            }
        },

        plugins: [createPersistedState()]

})