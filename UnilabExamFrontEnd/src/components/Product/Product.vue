<template>
    <div>
        <button class="btn btn-success mt-4" @click="createProduct">Create Product</button>
        <table class="table table-striped table-bordered mt-5">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>User</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="products.length < 1">
                    <td colspan="4" class="text-center">No Data</td>
                </tr>
                <tr v-else v-for="product in products" :key="product.id">
                    <td>{{ product.id }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.user.name }}</td>
                    <td>
                        <a class="badge badge-info p-2" @click="editProduct(product.id)">Edit</a>
                        <a class="badge badge-danger p-2" @click="deleteProduct(product.id)">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import {mapGetters} from 'vuex'

export default {
    name : 'product-list',
    data(){
        return {
            products : []
        }
    },
    methods : {
        getProducts(){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token

            axios.get('products?limit=8').then((response) => {
                this.products = response.data.data
            });
        },

        editProduct(id){
            this.$router.push('/products/'+id)
        },

        deleteProduct(id){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token

            axios.delete('products/'+id).then((response) => {
                alert(response.data);
                this.getProducts();
            });
        },
        
        createProduct(){
            this.$router.push('/product/create')
        }
    },
    computed: {
        ...mapGetters(['token'])
    },
    created(){
        this.getProducts();
    }

}
</script>

