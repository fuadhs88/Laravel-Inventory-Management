<template>
    <div>
        <div class="container">
<div class="row justify-content-left">
    <div class="col-lg-5 offset-2">
        <div class="card shadow-lg mt-5">
            <div class="card-header">
                <h3 class="text-center text-primary font-weight-bold my-3">Login</h3>
                </div>
            <div class="card-body">

                <form @submit.prevent="login">   
                    <div class="form-group">
                        <label class="mb-1" for="inputEmailAddress">Email</label>
                        <input class="form-control py-4" id="inputEmailAddress" type="email" placeholder="Enter Email Address" v-model="form.email"/>

                        <small class="text-danger" v-if="errors.email" style="color:red">{{ errors.email[0] }}</small> 
                    </div>

                    <div class="form-group">
                        <label class="mb-1" for="inputPassword">Password</label>
                        <input class="form-control py-4" id="inputPassword" type="password" v-model="form.password" placeholder="Enter Password"/>

                        <small class="text-danger" v-if="errors.password" style="color:red">{{ errors.password[0] }}</small> 
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                            <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                        </div>
                    </div>
                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                        <router-link to="/forget">Forgot Password?</router-link>
                        <button type="submit" class="btn btn-primary shadow"> Login </button>
                    </div>
                </form>

            </div>
            <div class="card-footer text-center">
                <div class="">
                    <router-link to="/register">Need an account? Sign up!</router-link>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</template>


<script>           
    export default {
        created(){                  
            if(User.loggedIn()){
                this.$router.push({name : 'home'})
            }
        },

        data(){
            return{
                form:{
                    email: null,        
                    password: null
                },
                errors:{}
            }
        },
        methods:{
            login(){
                axios.post('/api/auth/login',this.form)
                .then(response => {
                    User.responseAfterLogin(response)
                    Toast.fire({
                        icon: 'success',
                        title: 'Signed in Successfully'
                    })
                    this.$router.push({name:'home'})    
                })
                .catch(error => this.errors = error.response.data.errors)
                .catch(
                    Toast.fire({
                        icon: 'warning',
                        title: 'Email or Password Invalid'
                    })
                )
            }
        }
    }
</script>

<style>

</style>
