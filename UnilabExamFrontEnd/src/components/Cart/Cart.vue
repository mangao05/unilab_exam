<template>
    <div>
        <div v-show="carts.length < 1" class="alert alert-warning mt-5">You dont have item in cart. Order now!</div>
        
        <div v-for="cart in carts" :key="cart.id" class="alert alert-primary mt-4" role="alert">
            <h5>Item : <span class="text-danger text-uppercase">{{ cart.product_name }}</span></h5>
            <h6>Price: ₱ {{ cart.price }} / pc</h6>
            <h6>Quantity: {{ cart.quantity }}</h6>
            <h5>₱ {{ cart.total_price }}</h5>
        </div>

        <h4>Total Price: {{ totalAmount }}</h4>

        <button class="btn btn-success btn-block mb-4" @click="checkout()">Checkout</button>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    data(){
        return {
            carts : [],
            grandTotal : 0
        }
    },
    methods : {
        getCarts(){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token

            axios.get('cart').then((response) => {
                this.carts = response.data.data
            })
        },
        checkout(){
            
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token

            axios.post('orders', {
                'cart_ids' : this.cartIds
            }).then((response) => {
                alert(response.data);
                this.$router.push('/ordering');
            });

        }
    },
    created() {
        this.getCarts();
    },
    computed: {
        ...mapGetters(['token']),
         totalAmount: function () {
            var sum = 0;

            this.carts.forEach(e => {
                sum += e.total_price;
            });

            return sum
        },
        cartIds : function(){

            const ids = [];
            for(var i = 0; i < this.carts.length; i++){
                ids.push(this.carts[i].id);
            }

            return ids.toString();
        }
       
    },
}
</script>