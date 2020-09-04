<template>
    <div>

        <div v-if="products.length < 1" class="jumbotron mt-5">
            No Products
        </div>

        <div v-else class="row">
            <div class="card col-md-4" v-for="product in products" :key="product.id">
                <div class="card-body">
                    <h5 class="card-title text-capitalize">{{ product.name }}</h5>
                    <p class="card-text">₱{{ product.price }}</p>

                    <div class="">
                        <label>Quantity: </label>
                        <input type="number" class="form-control" v-model="quantity" />

                    </div>

                    <p>Store : {{ product.user.name }}</p>

                    <a href="#" class="btn btn-primary mt-2" @click="addToCart(product.id)">Add to cart</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {mapActions, mapGetters} from 'vuex'

export default {
    data() {
        return {
            products : [],
            carts : [],
            quantity : 1
        }
    }, 
    methods : {
        ...mapActions(['updateCartCount']),
        getProducts(){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token

            axios.get('products?limit=8').then((response) => {
                this.products = response.data.data
            });
        },
        getCartCount(){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token


            axios.get('getCartCount').then((response) => {
                this.updateCartCount(response.data)
            });
        },
        addToCart($id){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token

            axios.post('cart', {
                'quantity' : this.quantity,
                'product_id' : $id
            }).then((response) => {
                this.getCartCount()
                alert(response.data);
            });
        }
    },
    computed: {
        ...mapGetters(['token'])
    },
    created(){
        this.getProducts();
        this.getCartCount();
    }
}

</script>