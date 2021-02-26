<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb mt-3 shadow">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Order / Order Details</li>
        </ol>

        <!-----Order------->
        <div class="shadow">
            <div class="card">
                <div class="card-header text-primary" style="font-size: 20px; font-weight: 700;">
                    <i class="fas fa-chart-area"></i>
                    Order
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-6">
                            <table class="table border" id="" width="100%" cellspacing="0" style="font-size:2vh">
                                <tr>
                                    <th colspan="3" class="bg-info text-white shadow">Customer Details</th>
                                </tr>
                                <tr>
                                    <td width="30%">Name</td>
                                    <td width="5%">:</td>
                                    <td width="65%">{{ orders.name }}</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>:</td>
                                    <td>{{ orders.phone }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>:</td>
                                    <td>{{ orders.address }}</td>
                                </tr>
                                <tr>
                                    <td>Date</td>
                                    <td>:</td>
                                    <td>{{ Date(orders.order_date).toLocaleString() }}</td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td>:</td>
                                    <td>{{ Number(orders.qty).toLocaleString() }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6">
                            <table class="table border" id="" width="100%" cellspacing="0" style="font-size:2vh">
                                <tr>
                                    <td width="30%"><b>Sub-Total</b></td>
                                    <td width="5%">:</td>
                                    <td width="65%">{{ Number(orders.sub_total).toLocaleString() }} IDR</td>
                                </tr>
                                <tr>
                                    <td>VAT</td>
                                    <td>:</td>
                                    <td>{{ Number(orders.vat).toLocaleString() }} IDR</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>:</td>
                                    <td>{{ Number(orders.total).toLocaleString() }} IDR</td>
                                </tr>
                                <tr>
                                    <td>Pay</td>
                                    <td>:</td>
                                    <td>{{ Number(orders.pay).toLocaleString() }} IDR</td>
                                </tr>
                                <tr>
                                    <td>Due</td>
                                    <td>:</td>
                                    <td>{{ Number(orders.due).toLocaleString() }} IDR</td>
                                </tr>
                                <tr>
                                    <td>Payment Method</td>
                                    <td>:</td>
                                    <td>{{ orders.payby }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
        </div> <br>


        <!--------Order Details--------->
        <div class="shadow" style="margin-bottom:2rem">
            <div class="card">
                <div class="card-header text-primary" style="font-size: 20px; font-weight: 700;">
                    <i class="fas fa-chart-area"></i>
                    Order Details
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="input-group mb-3" style="width:400px;">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                            <input type="text" v-model="searchTerm" class="form-control" placeholder="Search Product Name" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <!-- <input type="text" v-model="searchTerm" class="form-control d-inline" style="width:200px;" placeholder="Search by name"><br><br> -->
                        <table class="table table-striped table-hover" id="" width="100%" cellspacing="0" style="font-size:2vh">

                            <thead class="shadow">
                                <tr class="text-white" style="background-color:#7E2E95;">
                                    <th>Product Name</th>
                                    <th>Code</th>
                                    <th>Image</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Sub-Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="detail in details" :key="detail.id">
                                    <td>{{ detail.product_name}}</td>
                                    <td>{{ detail.product_code}}</td>
                                    <td><img :src="'/'+detail.image" id="em_photo"></td>
                                    <td>{{ Number(detail.pro_quantity).toLocaleString() }}</td>
                                    <td>{{ Number(detail.product_price).toLocaleString() }} IDR</td>
                                    <td>{{ Number(detail.sub_total).toLocaleString() }} IDR</td>
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
        data(){
            return{
                //errors:{},
                orders:{},
                details:{},
            }
        },
        created(){
            let id = this.$route.params.id
        	axios.get('/api/order/details/'+id)
        	.then(({data}) => (this.orders = data))
            .catch()

        	axios.get('/api/order/orderdetails/'+id)
        	.then(({data}) => (this.details = data))
            .catch()
        },
        methods:{

        }
    }
</script>


<style scoped>
    #em_photo{
        height: 40px;
        width: 40px;
    }
</style>
