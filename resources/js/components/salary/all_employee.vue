 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb mt-3 shadow">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">All Employee / Salary</li>
        </ol>
        <!-- Icon Cards-->
       <div class="card shadow" style="margin-bottom:2rem">
          <div class="card-header text-primary" style="font-size: 20px; font-weight:700;">
            <i class="fas fa-chart-area"></i>
            Employee Salary Pay
          </div>
          <div class="card-body pt-0">
            <div class="card-body">
              <div class="table-responsive">
                <div class="input-group mb-3" style="width:400px;">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                  <input type="text" v-model="searchTerm" class="form-control" placeholder="Search Employee Name" aria-label="Username" aria-describedby="basic-addon1">
                </div>
               <!-- <input type="text" v-model="searchTerm" class="form-control d-inline" style="width:200px;" placeholder="Search by name"><br><br> -->
                <table class="table table-striped table-hover" id="" width="100%" cellspacing="0" style="font-size:2vh">

                  <thead class="shadow">
                    <tr class="text-white shadow" style="background-color:#7E2E95;">
                      <th>Name</th>
                      <th>Photo</th>
                      <th>Phone</th>
                      <th>Salary</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="employee in filtersearch" :key="employee.id">
                      <td>{{ employee.name }}</td>
                      <td><img :src="employee.photo" id="em_photo"></td>
                      <td>{{ employee.phone }}</td>
                      <td>{{ Number(employee.salary).toLocaleString() }} IDR</td>
                      <td>
                        <router-link :to="{name: 'pay-salary', params:{id: employee.id} }" class="btn btn-sm btn-info shadow">Pay Salary</router-link>
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
            this.allEmployee();
        },
        data(){
          return{
            employees:[],
            searchTerm:'',
          }
        },
       computed:{
         filtersearch(){
          return this.employees.filter(employee => {
             return employee.name.match(this.searchTerm)
           })
         }
       },
        methods:{
          allEmployee(){
            axios.get('/api/employee/')
            .then(({data}) => (this.employees = data))
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
