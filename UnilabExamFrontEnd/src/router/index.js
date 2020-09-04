import Vue from 'vue'
import Router from 'vue-router'
import Login from '@/components/Auth/Login'
import Products from '@/components/Product/Product'
import EditProduct from '@/components/Product/EditProduct'
import OrderProduct from '@/components/Ordering/OrderingProducts'
import Cart from '@/components/Cart/Cart'
import CreateProduct from '@/components/Product/CreateProduct'
import Orders from '@/components/Orders/Order'

Vue.use(Router)

export default new Router({
    mode : 'history',
    routes: [
      {
        path: '/',
        name: 'Login',
        component: Login
      },
      {
        path : '/products',
        name : 'Products',
        component : Products
      },
      {
        path : '/products/:id',
        name : 'EditProduct',
        component : EditProduct
      },
      {
        path : '/ordering',
        name : 'OrderingProduct',
        component : OrderProduct
      },
      {
        path: '/product/create',
        name: 'CreateProduct',
        component: CreateProduct
      },
      {
        path : '/cart',
        name : 'Cart',
        component : Cart
      },
      {
        path: '/orders',
        name : 'Orders',
        component : Orders
      }
    ]
})
