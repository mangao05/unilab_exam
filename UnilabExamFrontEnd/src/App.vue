<template>
  <div id="app" class="container">
    <template v-if="is_logged_in">
      	<nav class="navbar navbar-expand-lg navbar-light bg-light">

			<router-link to="/ordering" class="navbar-brand">Ordering</router-link>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">

					<li class="nav-item dropdown">
						<router-link to="/cart" class="nav-link">Cart <span class="badge badge-info">{{ cartCount }}</span> </router-link>
					</li>

				</ul>
				
				<a @click="logout" class="form-inline my-2 my-lg-0"> Logout </a>
				
			</div>

    	</nav>
		
		<div>
			Admin : 
			<router-link to="/orders" class="btn btn-info">Orders</router-link>
			<router-link to="/products" class="btn btn-primary">Products</router-link>
		</div>

		
	
    </template>
    
    <router-view/>

  </div>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'
export default {
  name: 'App',
  computed: {
	...mapGetters(['is_logged_in', 'token', 'cartCount']),
  },
  methods: {
	...mapActions(['doDestroyToken']),
	
	logout(){
		axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token

		axios.get('auth/logout').then((response) => {
			this.doDestroyToken();
			this.$router.push('/')
		})
	}
  },
}
</script>
