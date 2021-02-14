 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb mt-3 shadow">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">All Customer</li>
        </ol>
        <!-- Icon Cards-->
       <div class="card shadow" style="margin-bottom:2rem">
          <div class="card-header text-primary" style="font-size: 20px; font-weight:700;">
            <i class="fas fa-chart-area"></i>
            Customer Insert
            <router-link to="/store-Customer" class="btn btn-primary shadow" id="add_new"> Add New</router-link>
          </div>
          <div class="card-body">
            <div class="card-body">
              <div class="table-responsive">
                <div class="input-group mb-3" style="width:400px;">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                    <input type="text" v-model="searchTerm" class="form-control" placeholder="Search Customer Name" aria-label="Username" aria-describedby="basic-addon1">
                  </div>
               <!-- <input type="text" v-model="searchTerm" class="form-control d-inline" style="width:30%;" placeholder="Search by name"><br><br> -->
                <table class="table table-striped table-hover" id="" width="100%" cellspacing="0">
                  <thead class="shadow">
                    <tr class="text-white" style="background-color:#7E2E95;">
                      <th>Name</th>
                      <th>Photo</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="customer in filtersearch" :key="customer.id">
                      <td>{{ customer.name }}</td>
                      <td><img :src="customer.photo" id="em_photo"></td>
                      <td>{{ customer.phone }}</td>
                      <td>{{ customer.address }}</td>
                      <td>
                        <router-link :to="{name: 'edit-Customer', params:{id: customer.id} }" class="btn btn-sm btn-warning shadow" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></router-link>
                        <a @click="deleteCustomer(customer.id)" class="btn btn-sm btn-danger text-white shadow" data-toggle="tooltip" data-placement="top" title="Delete"><i class="far fa-trash-alt"></i></a>
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
            this.allCustomer();
        },
        data(){
          return{
            customers:[],
            searchTerm:'',
          }
        },
       computed:{
         filtersearch(){
          return this.customers.filter(customer => {
             return customer.name.match(this.searchTerm)
           })
         }
       },
        methods:{
          allCustomer(){
            axios.get('/api/Customer/')
            .then(({data}) => (this.customers = data))
            .catch()
          },
          deleteCustomer(id){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.value) {
              axios.delete('/api/Customer/'+id)
              .then(()=>{
                 this.customers = this.customers.filter(customer =>{
                    return customer.id !=id
                 })
              })
              .catch(()=>{
                 this.$router.push({name: 'Customer'})
              })
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            }
           })
          }
        },
    }
</script>


<style>
#add_new{
	float: right;
}
#em_photo{
  height: 50px;
  width: 50px;
}
</style>
