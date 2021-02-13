 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb mt-3 shadow">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">All Employee / View</li>
        </ol>
        <!-- Icon Cards-->
       <div class="shadow" style="margin-bottom:2rem">
          <div class="card-header text-primary" style="font-size: 20px; font-weight:700;">
            <i class="fas fa-chart-area"></i>
            Employee Salary Deatils
          </div>
          <div class="card-body">
            <div class="card-body">
              <div class="table-responsive">
                <div class="input-group mb-3" style="width:400px;">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                  <input type="text" v-model="searchTerm" class="form-control" placeholder="Search Employee Name" aria-label="Username" aria-describedby="basic-addon1">
                </div>
               <!-- <input type="text" v-model="searchTerm" class="form-control d-inline" style="width:200px;" placeholder="Search by name"> <br><br> -->
                <table class="table table-striped table-hover" id="" width="100%" cellspacing="0">
                  <thead class="shadow">
                    <tr class="text-white" style="background-color:#7E2E95;">
                      <th>Name</th>
                      <th>Month</th>
                      <th>Amount</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="salary in filtersearch" :key="salary.id">
                      <td>{{ salary.name }}</td>
                      <td>{{ salary.salary_month }}</td>
                      <td>Rp. {{ Number(salary.amount).toLocaleString() }}</td>
                       <td>{{ salary.salary_date }}</td>
                      <td>
                        <router-link :to="{name: 'edit-salary', params:{id: salary.id} }" class="btn btn-sm btn-info shadow">Edit Salary</router-link>
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
          this.viewSalary();
        },
        data(){
          return{
            salaries:[],
            searchTerm:'',
          }
        },
       computed:{
         filtersearch(){
          return this.salaries.filter(salary => {
             return salary.name.match(this.searchTerm)
           })
         }
       },
        methods:{
          viewSalary(){
            let id = this.$route.params.id
    		axios.get('/api/salary/view/'+id)
    		.then(({data}) => (this.salaries = data))
    		.catch(error => this.errors = error.response.data.errors)
          },
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
