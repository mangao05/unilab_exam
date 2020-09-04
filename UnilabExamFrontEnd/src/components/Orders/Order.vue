<template>

    <div>
        <table class="table table-striped table-bordered table hover mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>User</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="orders.length < 1">
                    <td class="text-center" colspan="6">No Data</td>
                </tr>
                <tr v-else v-for="(order, index) in orders" :key="order.id">
                    <td scope="row"> {{ index + 1 }}</td>
                    <td>{{ order.name }}</td>
                    <td>{{ order.price }}</td>
                    <td>{{ order.quantity }}</td>
                    <td>{{ order.user }}</td>
                    <td>{{ order.total_price }}</td>
                </tr> 
            </tbody>
        </table>
    </div>

</template>

<script>
import { mapGetters } from 'vuex'
export default {
    data(){
        return {
            orders : []
        }
    },
    methods: {
        getOrders(){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token
            
            axios.get('orders').then((response) => {
                this.orders = response.data.data
            })
        }
    },
    created() {
        this.getOrders();
    },
    computed: {
        ...mapGetters(['token'])
    },
}
</script>