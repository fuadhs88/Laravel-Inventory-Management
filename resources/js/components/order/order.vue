 <template>
    <div>
        <ol class="breadcrumb mt-3 shadow">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Monthly Order</li>
        </ol>
       <div class="card shadow" style="margin-bottom:2rem">
          <div class="card-header text-primary" style="font-size: 20px; font-weight:700;">
            <i class="fas fa-chart-area"></i>
            Monhtly Order List
          </div>
          <div class="card-body pt-0">
            <div class="card-body">
              <div class="table-responsive">
                <div class="input-group mb-3" style="width:400px;">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                  <input type="text" v-model="searchTerm" class="form-control" placeholder="Search Order Name" aria-label="Username" aria-describedby="basic-addon1">
                </div>
               <!-- <input type="text" v-model="searchTerm" class="form-control d-inline" style="width:200px;" placeholder="Search by Name"><br><br> -->
                <table class="table table-striped table-hover" id="" width="100%" cellspacing="0" style="font-size:2vh">

                  <thead class="shadow">
                    <tr class="text-white" style="background-color:#7E2E95;">
                      <th>Name</th>
                      <th>Total Amount</th>
                      <th>Pay</th>
                      <th>Due</th>
                      <th>Payby</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="monthlyorders in filtersearch" :key="monthlyorders.id">
                      <td>{{ monthlyorders.name }}</td>
                      <td>{{ Number(monthlyorders.total).toLocaleString() }} IDR</td>
                      <td>{{ Number(monthlyorders.pay).toLocaleString() }} IDR</td>
                      <td>{{ Number(monthlyorders.due).toLocaleString() }} IDR</td>
                      <td>{{ monthlyorders.payby }}</td>
                      <td>
                        <router-link :to="{name: 'view-order', params:{id: monthlyorders.id} }" class="btn btn-sm btn-info shadow">View</router-link>
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
            this.allOrder();
        },
        data(){
          return{
            orders:[],
            monthlyorders:[],
            searchTerm:'',
          }
        },
        computed:{
            filtersearch(){
                return this.orders.filter(order => {
                    return order.name.match(this.searchTerm)
                })
            }
        },
        methods:{
          allOrder(){
            axios.get('/api/orders/')
            .then(({data}) => (this.orders = data))
            .catch()
          },
          monthOrder(){
            axios.get('/api/monthly/orders/')
            .then(({data}) => (this.monthlyorders = data))
            .catch()
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
