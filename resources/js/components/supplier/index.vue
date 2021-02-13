<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb mt-3 shadow">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">All Supplier</li>
        </ol>
        <!-- Icon Cards-->
        <div class="shadow" style="margin-bottom:2rem">
            <div class="card-header text-primary" style="font-size: 20px; font-weight:700;">
                <i class="fas fa-chart-area"></i>
                All Supplier
                <router-link to="/store-supplier" class="btn btn-primary shadow" id="add_new"> Add New</router-link>
            </div>
            <div class="card-body pt-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="input-group mb-3" style="width:400px;">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                            <input type="text" v-model="searchTerm" class="form-control" placeholder="Search Mobile Phone Number" aria-label="Username" aria-describedby="basic-addon1">
                        </div>     <!-----f----->
                        <!-- <input type="text" v-model="searchTerm" class="form-control d-inline" style="width:200px;" placeholder="Search by phone"><br> <br> -->
                        <table class="table table-striped table-hover" id="" width="100%" cellspacing="0">

                            <thead class="align-middle shadow">
                            <tr class="text-white" style="background-color:#7E2E95;">
                                <th scope="col">Name</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Vendor</th>
                                <th scope="col">Address</th>
                                <th style="width:10%">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="supplier in filtersearch" :key="supplier.id">
                                <td>{{ supplier.name }}</td>
                                <td><img :src="supplier.photo" id="em_photo"></td>
                                <td>{{ supplier.phone }}</td>
                                <td>{{ supplier.shopname }}</td>
                                <td>{{ supplier.address }}</td>
                                <td>
                                    <router-link :to="{name: 'edit-supplier', params:{id: supplier.id} }" class="btn btn-sm btn-warning shadow" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></router-link>
                                    <a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger text-white shadow" data-toggle="tooltip" data-placement="top" title="Delete"><i class="far fa-trash-alt"></i></a>
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
            this.allSupplier();
        },
        data(){
            return{
                suppliers:[],
                searchTerm:'',
            }
        },
        computed:{
            filtersearch(){
                return this.suppliers.filter(supplier => {
                    return supplier.phone.match(this.searchTerm)
                })
            }
        },
        methods:{
            allSupplier(){
                axios.get('/api/supplier/')
                    .then(({data}) => (this.suppliers = data))
                    .catch()
            },
            deleteSupplier(id){
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
                        axios.delete('/api/supplier/'+id)
                            .then(()=>{
                                this.suppliers = this.suppliers.filter(supplier =>{
                                    return supplier.id !=id
                                })
                            })
                            .catch(()=>{
                                this.$router.push({name: 'supplier'})
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
    #em_photo{
        height: 40px;
        width: 40px;
    }
</style>
