<template>
    <div class="p-5 col-md-6 mx-auto">
    
        <h2>Edit Product : <span class="text-uppercase text-warning">{{ product.name }}</span></h2>  

        <form @submit.prevent="updateProduct">
            <div class="form-group">
                <label>Product Name</label>
                
                <input  type="text" 
                        v-model="product.name"
                        class="form-control" 
                        placeholder="Product Name"
                 >
            </div>
            <div class="form-group">
                <label>Price</label>

                <input  type="number" 
                        v-model="product.price" 
                        class="form-control" 
                        placeholder="Product Price">
            </div>
            
            <input type="submit" 
                    class="btn btn-info btn-block" 
                    value="Update"
                    />
        </form>
    </div>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
    data(){
        return {
            product : {}
        }
    },
    methods: {
        showProduct() {
            var id = this.$route.params.id;

            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token
            axios.get('products/'+id).then((response) => {
                this.product = response.data
            })
        },
        updateProduct(){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token
            
            axios.put('products/'+this.product.id, {
                'name' : this.product.name,
                'price' : this.product.price
            }).then((response) => {
                alert(response.data)
            })
        }
    },
    computed: {
        ...mapGetters(['token'])
    },
    created(){
        this.showProduct();
    }
}
</script>