
<template>
    <div>
<!--------------------Dashboard------------------------>
<h1 class="mt-4" style="font-weight: 900;color:white">DASHBOARD</h1>
<ol class="breadcrumb mb-4 shadow">
    <li class="breadcrumb-item active">Summary Report UMKM Gonkricaw</li>
</ol>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4 shadow" style="border: none;background-image:linear-gradient(45deg,#30496B,#30B8D2)">
            <div class="card-body">{{ Number(monthlysell).toLocaleString() }} IDR</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class=" text-white stretched-link" href="#">This Month Sell</a>
                <div class=" text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4 shadow" style="border: none;background-image:linear-gradient(-45deg,#95FD48,#19E9A6)">
            <div class="card-body">{{ Number(income).toLocaleString() }} IDR</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class=" text-white stretched-link" href="#">Today Income</a>
                <div class=" text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4 shadow" style="border: none;background-image:linear-gradient(-45deg,#DA1FF2,#4C15D0)">
            <div class="card-body">{{ Number(due).toLocaleString() }} IDR</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class=" text-white stretched-link" href="#">This Month Due</a>
                <div class=" text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4 shadow" style="border: none;background-image:linear-gradient(45deg,#FB7140,#FB9951)">
            <div class="card-body">{{ Number(expense).toLocaleString() }} IDR</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class=" text-white stretched-link" href="#">This Month Expense</a>
                <div class=" text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>      <!------End_Dashboard------>

<!------Stock Products------>
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
</div>  <!------End Stock Products------>


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
            this.Stockout();
        },
        data(){
            return{
                monthlysell:'',
                income:'',
                expense:'',
                due:'',
                products:'',
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
            Stockout(){
                axios.get('/api/stockout')
                    .then(({data}) => (this.products = data))
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
