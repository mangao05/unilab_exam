<template>
    <div class="col-md-4 mx-auto">
        <div v-show="error" class="alert alert-danger">{{ errormsg }}</div>
        
         <form @submit.prevent="login" @keydown="form.onKeydown($event)">
            <div class="form-group">

                <label>Username</label>

                <input v-model="form.username" 
                        type="text" 
                        name="username"
                        class="form-control" 
                        :class="{ 'is-invalid': form.errors.has('username') }
                        ">
                <has-error :form="form" field="username"></has-error>

            </div>

            <div class="form-group">

                <label>Password</label>

                <input v-model="form.password" 
                                type="password" 
                                name="password"
                                class="form-control" 
                                :class="{ 'is-invalid': form.errors.has('password') }
                                ">

                <has-error :form="form" field="password"></has-error>

            </div>

            <button :disabled="form.busy" 
                    type="submit" 
                    class="btn btn-primary btn-block"
                    >Log In</button>
        </form>
    </div>
</template>

<script>
import {mapActions} from 'vuex'
export default {
    name : 'login',
    data () {
        return {
            form: new Form({
                username: '',
                password: ''
            }),
            errormsg : '',
            error : false
        }
    },

    methods: {
        ...mapActions(['doRetrieveToken']),
        
        login () {
            this.form.post('auth/login')
                .then((response) => { 
                    if(response.data === 'Oops! These credentials do not match our records.'){
                        this.errormsg = response.data
                        this.error = true
                        return;
                    } 

                    this.doRetrieveToken(response.data.token)
                    this.$router.push('/ordering');
                    
                 })
            }
        }
}
</script>

<style lang="css">
    
</style>