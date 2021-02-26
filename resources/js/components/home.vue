
<template>
    <div>
<h1 class="mt-4" style="font-weight: 900;color:white">DASHBOARD</h1>
<ol class="breadcrumb mb-4 shadow">
    <li class="breadcrumb-item active">Summary Report UMKM Gonkricaw</li>
</ol>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4 shadow" style="border: none;background-image:linear-gradient(-45deg,#DA1FF2,#4C15D0);">
            <div class="row">
                <div class="col-2">
                    <div class="card-body"><i class="fas fa-chart-bar fa-lg"></i></div>
                </div>
                <div class="col-10">
                    <div class="card-body">{{ Number(monthlysell).toLocaleString() }} IDR</div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class=" text-white stretched-link" href="#">This Month Sell</a>
                <div class=" text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4 shadow" style="border: none;background-image:linear-gradient(-45deg,#DA1FF2,#4C15D0);">
            <div class="row">
                <div class="col-2">
                    <div class="card-body"><i class="fas fa-chart-bar fa-lg"></i></div>
                </div>
                <div class="col-10">
                    <div class="card-body">{{ Number(income).toLocaleString() }} IDR</div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class=" text-white stretched-link" href="#">This Month Income</a>
                <div class=" text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4 shadow" style="border: none;background-image:linear-gradient(-45deg,#DA1FF2,#4C15D0)">
            <div class="row">
                <div class="col-2">
                    <div class="card-body"><i class="fas fa-chart-bar fa-lg"></i></div>
                </div>
                <div class="col-10">
                    <div class="card-body">{{ Number(due).toLocaleString() }} IDR</div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class=" text-white stretched-link" href="#">This Month Due</a>
                <div class=" text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4 shadow" style="border: none;background-image:linear-gradient(-45deg,#DA1FF2,#4C15D0)">
            <div class="row">
                <div class="col-2">
                    <div class="card-body"><i class="fas fa-chart-bar fa-lg"></i></div>
                </div>
                <div class="col-10">
                    <div class="card-body">{{ Number(expense).toLocaleString() }} IDR</div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class=" text-white stretched-link" href="#">This Month Expense</a>
                <div class=" text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4 shadow" style="border: none;background-image: linear-gradient(to right, #868f96 0%, #596164 100%);">
            <div class="row">
                <div class="col">
                    <div class="card-body"><i class="fas fa-chart-bar fa-lg"></i></div>
                </div>
                <div class="col-10">
                    <div class="card-body">{{ Number(totalasset).toLocaleString() }}</div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class=" text-white stretched-link" href="#">Total Revenue Asset</a>
                <div class=" text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4 shadow" style="border: none;background-image: linear-gradient(to right, #868f96 0%, #596164 100%);">
            <div class="row">
                <div class="col">
                    <div class="card-body"><i class="fas fa-cube fa-lg"></i></div>
                </div>
                <div class="col-10">
                    <div class="card-body">{{ Number(totalstock).toLocaleString() }}</div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class=" text-white stretched-link" href="#">Available Stock Item</a>
                <div class=" text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4 shadow" style="border: none;background-image: linear-gradient(to right, #868f96 0%, #596164 100%);">
            <div class="row">
                <div class="col">
                    <div class="card-body"><i class="fab fa-shopify fa-lg"></i></div>
                </div>
                <div class="col-10">
                    <div class="card-body">{{ Number(totalorder).toLocaleString() }}</div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class=" text-white stretched-link" href="#">Total Transaction</a>
                <div class=" text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4 shadow" style="border: none;background-image: linear-gradient(to right, #868f96 0%, #596164 100%);">
            <div class="row">
                <div class="col">
                    <div class="card-body"><i class="fas fa-cubes fa-lg"></i></div>
                </div>
                <div class="col-10">
                    <div class="card-body">{{ Number(itemout).toLocaleString() }}</div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class=" text-white stretched-link" href="#">Total Stock-Out</a>
                <div class=" text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="row my-3">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-header text-primary font-weight-bold">
                <i class="fas fa-chart-area mr-1"></i>
                Products Stock
            </div>
            <div class="card-body">
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="" width="100%" cellspacing="0" style="font-size:2vh">
                            <thead class="shadow">
                                <tr class="text-white" style="background-color:#572478">
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>PIC</th>
                                    <th>Status</th>
                                    <th>Available Product</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="product in products" :key="product.id">
                                    <td>{{ product.product_name}}</td>
                                    <td>{{ product.product_code}}</td>
                                    <td><img :src="product.image" id="em_photo"></td>
                                    <td v-if="product.product_quantity >= 1"><span class="badge badge-success shadow">Availble</span></td>
                                    <td v-else><span class="badge badge-danger shadow">Stock Out</span></td>
                                    <td>{{ Number(product.product_quantity).toLocaleString() }}</td>
                                </tr>
                            </tbody>
                        </table>
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
        if (!User.loggedIn()) {
            this.$router.push({name : '/'})
        }
        },
        mounted(){
            this.MonthlySell();
            this.MonthlyIncome();
            this.MonthlyDue();
            this.MonthlyExpense();
            this.AvailableStock();
            this.TotalStock();
            this.TotalAsset();
            this.TotalTransaction();
            this.StockOut();
            this.TotalCustomers();
            this.TotalSuppliers();
        },
        data(){
            return{
                monthlysell:'',
                income:'',
                expense:'',
                due:'',
                products:'',
                totalstock:'',
                totalasset:'',
                totalorder:'',
                itemout:'',
                totalcustomer:'',
                totalsupplier:''
            }
        },
        methods:{
            MonthlySell(){
                axios.get('/api/monthly/sell')
                    .then(({data}) => (this.monthlysell = data))
                    .catch()
            },
            MonthlyIncome(){
                axios.get('/api/monthly/income')
                    .then(({data}) => (this.income = data))
                    .catch()
            },
            MonthlyDue(){
                axios.get('/api/monthly/due')
                    .then(({data}) => (this.due = data))
            },
            MonthlyExpense(){
                axios.get('/api/monthly/expense')
                    .then(({data}) => (this.expense = data))
            },
            AvailableStock(){
                axios.get('/api/availstock')
                    .then(({data}) => (this.products = data))
            },
            TotalStock(){
                axios.get('/api/total/stock')
                    .then(({data}) => (this.totalstock = data))
            },
            TotalAsset(){
                axios.get('/api/total/asset')
                    .then(({data}) => (this.totalasset = data))
            },
            TotalTransaction(){
                axios.get('/api/total/order')
                    .then(({data}) => (this.totalorder = data))
            },
            StockOut(){
                axios.get('/api/stockout')
                    .then(({data}) => (this.itemout = data))
            },
            TotalCustomers(){
                axios.get('/api/total/customer')
                    .then(({data}) => (this.totalcustomer = data))
            },
            TotalSuppliers(){
                axios.get('/api/total/supplier')
                    .then(({data}) => (this.totalsupplier = data))
            },
        }
    }
</script>


<style scoped>
    #em_photo{
        height: 40px;
        width: 40px;
    }
</style>
