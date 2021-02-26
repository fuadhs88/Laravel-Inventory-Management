<template>
    <div>
        <ol class="breadcrumb mt-3 shadow">
            <li class="breadcrumb-item">
                <router-link to="/"><a href="#">Dashboard</a></router-link>
            </li>
            <li class="breadcrumb-item">
                <router-link to="/category"><a href="#">Category</a></router-link>
            </li>
            <li class="breadcrumb-item active">
                Insert
            </li>
        </ol>
        <div class="shadow" style="margin-bottom:2rem">
            <div class="card">
                <div class="card-header text-primary" style="font-size: 20px; font-weight: 700;">
                    <i class="fas fa-chart-area"></i>
                    Category Insert
                    <router-link to="/category" class="btn btn-primary shadow" id="add_new"> All Category</router-link>
                </div>

                <div class="card-body">
                    <form @submit.prevent="categoryInsert">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <label>Category Name : </label>
                                        <input type="text" v-model="form.category_name" class="form-control" required placeholder="Enter Category Name">
                                        <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary shadow">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        mounted(){
            if (!User.loggedIn()) {
                this.$router.push({ name:'/' })
            }
        },
        data(){
            return{
                form:{
                    category_name :''
                },
                errors:{},
            }
        },
        methods:{
            categoryInsert(){
                axios.post('/api/category/',this.form)
                    .then(() => {
                        this.$router.push({ name: 'category' })
                        Notification.success()
                    })
                    .catch(error => this.errors = error.response.data.errors)
            },
        }
    }
</script>


<style>
    #add_new{
        float: right;
    }
</style>
