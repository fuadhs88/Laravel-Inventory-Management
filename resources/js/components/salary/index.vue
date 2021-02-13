 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb mt-3 shadow">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">All Salary / Index</li>
        </ol>
        <!-- Icon Cards-->
       <div class="shadow" style="margin-bottom:2rem">
          <div class="card-header text-primary" style="font-size: 20px; font-weight:700;">
            <i class="fas fa-chart-area"></i>
           All Salary Details
          </div>
          <div class="card-body pt-0">
            <div class="card-body">
              <div class="table-responsive">
                <div class="input-group mb-3" style="width:400px;">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                  <input type="text" v-model="searchTerm" class="form-control" placeholder="Search Month" aria-label="Username" aria-describedby="basic-addon1">
                </div>
               <!-- <input type="text" v-model="searchTerm" class="form-control d-inline" style="width:200px;" placeholder="Search by month"> <br><br> -->
                <table class="table table-striped table-hover" id="" width="100%" cellspacing="0">

                  <thead class="shadow">
                    <tr class="text-white" style="background-color:#7E2E95;">
                      <th>Month Name</th>
                      <th>Details</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="salary in filtersearch" :key="salary.salary_month">
                      <td>{{ salary.salary_month }}</td>
                      <td>
                        <router-link :to="{name: 'view-salary', params:{id: salary.salary_month} }" class="btn btn-sm btn-info shadow">View Salary</router-link>
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
            this.allSalary();
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
             return salary.salary_month.match(this.searchTerm)
           })
         }
       },
        methods:{
          allSalary(){
            axios.get('/api/salary/')
            .then(({data}) => (this.salaries = data))
            .catch()
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
