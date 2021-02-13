<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb mt-3 shadow">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">All Category</li>
        </ol>
        <!-- Icon Cards-->
        <div class="shadow" style="margin-bottom:2rem">
            <div class="card-header text-primary" style="font-size: 20px; font-weight:700;">
                <i class="fas fa-chart-area"></i>
                All Category
                <router-link to="/store-category" class="btn btn-primary shadow" id="add_new"> Add New</router-link>
            </div>
            <div class="card-body pt-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="input-group mb-3" style="width:400px;">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                            <input type="text" v-model="searchTerm" class="form-control" placeholder="Search Catagory Name" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <!-- <input type="text" v-model="searchTerm" class="form-control d-inline" style="width:200px;" placeholder="Search by name"><br><br> -->
                        <table class="table table-striped table-hover" id="" width="100%" cellspacing="0">

                            <thead class="shadow">
                            <tr class="text-white" style="background-color:#7E2E95;">
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="category in filtersearch" :key="category.id">
                                <td>{{ category.category_name }}</td>
                                <td>
                                    <router-link :to="{name: 'edit-category', params:{id: category.id} }" class="btn btn-sm btn-warning shadow" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></router-link>
                                    <a @click="deleteCategory(category.id)" class="btn btn-sm btn-danger text-white shadow" data-toggle="tooltip" data-placement="top" title="Delete"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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
        created(){
            this.allCategory();
        },
        data(){
            return{
                categories:[],
                searchTerm:'',
            }
        },
        computed:{
            filtersearch(){
                return this.categories.filter(category => {
                    return category.category_name.match(this.searchTerm)
                })
            }
        },
        methods:{
            allCategory(){
                axios.get('/api/category/')
                    .then(({data}) => (this.categories = data))
                    .catch()
            },
            deleteCategory(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/category/'+id)
                            .then(()=>{
                                this.categories = this.categories.filter(category =>{
                                    return category.id !=id
                                })
                            })
                            .catch(()=>{
                                this.$router.push({name: 'category'})
                            })
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            }
        },
    }
</script>


<style>
    #add_new{
        float: right;
    }
</style>
