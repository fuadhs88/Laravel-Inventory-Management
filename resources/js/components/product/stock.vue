<template>
    <div>
        <ol class="breadcrumb mt-3 shadow">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Stock</li>
        </ol>
        <div class="card shadow" style="margin-bottom:2rem">
            <div class="card-header text-primary" style="font-size: 20px; font-weight:700;">
                <i class="fas fa-chart-area"></i>
                Stock
            </div>
            <div class="card-body">
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <div class="input-group mb-3" style="width:400px;">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                            <input type="text" v-model="searchTerm" class="form-control" placeholder="Search Product Name" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <table class="table table-striped table-hover" width="100%" cellspacing="0" style="font-size:2vh">
                            <thead class="shadow">
                            <tr class="text-white" style="background-color:#7E2E95;">
                                <th>Name</th>
                                <th>Code</th>
                                <th>Photo</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Qty</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="product in filtersearch" :key="product.id">
                                <td>{{ product.product_name}}</td>
                                <td>{{ product.product_code}}</td>
                                <td><img :src="product.image" id="em_photo"></td>
                                <td>{{ product.category_name }}</td>
                                <td v-if="product.product_quantity >= 1"><span class="badge badge-success shadow">Availble</span></td>
                                <td v-else><span class="badge badge-danger">Stock Out</span></td>
                                <td>{{ Number(product.product_quantity).toLocaleString() }}</td>
                                <td>
                                    <router-link :to="{name: 'edit-stock', params:{id: product.id} }" class="btn btn-sm btn-info shadow">Edit</router-link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
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

        created(){
            this.allProduct();
        },

        data(){
            return{
                products:[],
                searchTerm:'',
            }
        },
        computed:{
            filtersearch(){
                return this.products.filter(product => {
                    return product.product_name.match(this.searchTerm)
                })
            }
        },
        methods:{
            allProduct(){
                axios.get('/api/product/')
                    .then(({data}) => (this.products = data))
                    .catch()
            }
        }
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
