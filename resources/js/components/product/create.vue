<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb mt-3 shadow">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Product / Insert</li>
        </ol>
        <!-- Icon Cards-->
        <div class="shadow" style="margin-bottom:2rem">
            <div class="card">
                <div class="card-header text-primary" style="font-size: 20px; font-weight: 700;">
                    <i class="fas fa-chart-area"></i>
                    Product Insert
                    <router-link to="/product" class="btn btn-primary shadow" id="add_new"> All Product</router-link>
                </div>
                <div class="card-body">
                    <form @submit.prevent="productInsert" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <label>Product Name</label>
                                        <input type="text" v-model="form.product_name" class="form-control" required placeholder="Enter Product Name">
                                        <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <label >Product Code</label>
                                        <input type="text" v-model="form.product_code" class="form-control" required placeholder="Enter Product Code" >
                                        <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampl1">Category</label>
                                        <select class="form-control" id="exampl1" v-model="form.category_id">
                                            <option :value="category.id" v-for="category in categories" :key="category.id">{{ category.category_name }}</option>
                                        </select>
                                        <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Supplier</label>
                                        <select class="form-control" v-model="form.supplier_id">
                                            <option :value="supplier.id" v-for="supplier in suppliers" :key="supplier.id">{{ supplier.name }}</option>
                                        </select>
                                        <small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>
                                    </div>
                                </div>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <label>Buying Date</label>
                                        <input type="date" v-model="form.buying_date" class="form-control" required>
                                        <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <label>Quantity</label>
                                        <input type="number" v-model="form.product_quantity" class="form-control" required placeholder="Enter Quantity">
                                        <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                                    </div>
                                </div>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-label-group">
                                        <label>Sub-Catagory</label>
                                        <input type="text" v-model="form.root" class="form-control" required placeholder="Enter Sub-Catagory">
                                        <small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-label-group">
                                        <label >Buying Price</label>
                                        <input type="text" v-model="form.buying_price" class="form-control" required placeholder="Enter Buying Price">
                                        <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-label-group">
                                         <label >Selling Price </label>
                                        <input type="text" v-model="form.selling_price" class="form-control" required placeholder="Enter Selling Price">
                                        <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
                                    </div>
                                </div>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="file" class="btn btn-info" @change="onFileselected">
                                        <small class="text-danger" v-if="errors.image">{{ errors.image[0] }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img :src="form.image" class="img-thumbnail" style="height:150px; width: 150px;">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary shadow">Submit</button>
                    </form>
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
        data(){
            return{
                form:{
                    product_name :'',
                    product_code :'',
                    category_id:'',
                    supplier_id:'',
                    root :'',
                    buying_price:'',
                    selling_price : '',
                    buying_date:'',
                    image:'backend/img/noimage.png',
                    product_quantity:''
                },
                errors:{},
                categories:{},      
                suppliers:{},       
            }
        },
        methods:{
            onFileselected(event){
                let file=event.target.files[0];
                if (file.size > 1048770) {
                    Notification.image_validation()
                }else{
                    let reader = new FileReader();
                    reader.onload = event => {
                        this.form.image = event.target.result
                        //console.log(event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            },
            productInsert(){
                axios.post('/api/product/',this.form)
                    .then(() => {
                        this.$router.push({ name: 'product' })
                        Notification.success()
                    })
                    .catch(error => this.errors = error.response.data.errors)
            },
        },
        created(){            
            axios.get('/api/category')
                .then(({data}) => (this.categories = data))

            axios.get('/api/supplier/')
                .then(({data}) => (this.suppliers = data))
        },
    }
</script>


<style>
    #add_new{
        float: right;
    }
</style>
