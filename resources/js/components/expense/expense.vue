 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb mt-3 shadow">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">All Expense</li>
        </ol>
        <!-- Icon Cards-->
       <div class="card shadow" style="margin-bottom:2rem">
          <div class="card-header text-primary" style="font-size: 20px; font-weight:700;">
            <i class="fas fa-chart-area"></i>
            All Expense
            <router-link to="/store-expense" class="btn btn-primary shadow" id="add_new"> Add New</router-link>
          </div>
          <div class="card-body pt-0">
            <div class="card-body">
              <div class="table-responsive">
                <div class="input-group mb-3" style="width:400px;">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                  <input type="text" v-model="searchTerm" class="form-control" placeholder="Search Date" aria-label="Username" aria-describedby="basic-addon1">
                </div>
               <!-- <input type="text" v-model="searchTerm" class="form-control d-inline" style="width:200px;" placeholder="Search by date"><br><br> -->
                <table class="table table-striped table-hover" width="100%" cellspacing="0">

                  <thead class="shadow">
                    <tr class="text-white" style="background-color:#7E2E95;">
                      <th>Expense Description</th>
                      <th>Amount</th>
                      <th>Input Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="expense in filtersearch" :key="expense.id">
                      <td>{{ expense.details }}</td>
                      <td>Rp. {{ Number(expense.amount).toLocaleString() }}</td>
                      <td>{{ expense.expense_date }}</td>
                      <td>
                        <router-link :to="{name: 'edit-expense', params:{id: expense.id} }" class="btn btn-sm btn-warning shadow" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></router-link>
                        <a @click="deleteExpense(expense.id)" class="btn btn-sm btn-danger text-white shadow" data-toggle="tooltip" data-placement="top" title="Delete"><i class="far fa-trash-alt"></i></a>
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
            this.allExpense();
        },
        data(){
          return{
            expenses:[],
            searchTerm:'',
          }
        },
       computed:{
         filtersearch(){
          return this.expenses.filter(expense => {
             return expense.expense_date.match(this.searchTerm)
           })
         }
       },
        methods:{
          allExpense(){
            axios.get('/api/expense/')
            .then(({data}) => (this.expenses = data))
            .catch()
          },
          deleteExpense(id){
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
              axios.delete('/api/expense/'+id)
              .then(()=>{
                 this.expenses = this.expenses.filter(expense =>{
                    return expense.id !=id
                 })
              })
              .catch(()=>{
                 this.$router.push({name: 'expense'})
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
    height: 40px;
    width: 40px;
    }
</style>
