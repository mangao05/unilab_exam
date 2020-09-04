<template>
    <div>
        <div class="p-5 col-md-6 mx-auto">
    
            <h2>Create Product</h2>  

            <form @submit.prevent="saveProduct()">
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
                        value="Create"
                        />
            </form>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
    data(){
        return {
            product : {
                name : '',
                price : 1
            }
        }
    },
    methods: {
        saveProduct(){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token
            
            if(this.product.name === '' || this.product.price === ''){
                alert('All fields are required !');
                return;
            }

            axios.post('products', {
                'name' : this.product.name,
                'price' : this.product.price
            }).then((response) => {
                alert(response.data);
                this.$router.push('/products');
            })
        }
    },
    computed: {
        ...mapGetters(['token'])
    },
}
</script>