 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb mt-3 shadow">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Today Order</li>
        </ol>
        <!-- Icon Cards-->
       <div class="card shadow" style="margin-bottom:2rem">
          <div class="card-header text-primary" style="font-size: 20px; font-weight:700;">
            <i class="fas fa-chart-area"></i>
            Today's Order-Table
          </div>
          <div class="card-body pt-0">
            <div class="card-body">
              <div class="table-responsive">
                <div class="input-group mb-3" style="width:400px;">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                  <input type="text" v-model="searchTerm" class="form-control" placeholder="Search Order Name" aria-label="Username" aria-describedby="basic-addon1">
                </div>
               <!-- <input type="text" v-model="searchTerm" class="form-control d-inline" style="width:200px;" placeholder="Search by Name"><br><br> -->
                <table class="table table-striped table-hover" id="" width="100%" cellspacing="0">

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
                    <tr v-for="order in filtersearch" :key="order.id">
                      <td>{{ order.name }}</td>
                      <td>{{ Number(order.total).toLocaleString() }}</td>
                      <td>{{ Number(order.pay).toLocaleString() }}</td>
                      <td>{{ Number(order.due).toLocaleString() }}</td>
                      <td>{{ order.payby }}</td>
                      <td>
                        <router-link :to="{name: 'view-order', params:{id: order.id} }" class="btn btn-sm btn-info shadow">View</router-link>
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
