<template>
    <div>
        <ol class="breadcrumb shadow mt-3">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">All Employee</li>
        </ol>
        <div class="card shadow" style="margin-bottom:2rem">
            <div class="card-header text-primary" style="font-size: 20px; font-weight:700;">
                <i class="fas fa-chart-area"></i>
                All Employee
                <router-link to="/store-employee" class="btn btn-primary shadow" id="add_new"> Add Employee</router-link>
            </div>
            <div class="card-body pt-0">      
                <div class="card-body">
                    <div class="table-responsive"> 
                        <div class="input-group mb-3" style="width:400px;">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                            <input type="text" v-model="searchTerm" class="form-control" placeholder="Search Employee Name" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <table class="table table-striped table-hover" id="" width="100%" cellspacing="0" style="font-size:2vh">

                            <thead class="shadow">
                            <tr class="text-white" style="background-color:#7E2E95">
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Phone</th>
                                <th>Salary</th>
                                <th>Joining Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="employee in filtersearch" :key="employee.id">    
                                <td>{{ employee.name }}</td>
                                <td><img :src="employee.photo" class="img-thumbnail" id="em_photo"></td>
                                <td>{{ employee.phone }}</td>
                                <td>{{ Number(employee.salary).toLocaleString() }} IDR</td>
                                <td>{{ employee.joining_date }}</td>
                                <td>
                                    <router-link :to="{name: 'edit-employee', params:{id: employee.id} }" class="btn btn-sm btn-warning shadow" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></router-link>    <!----it will dynamic thats why applied bind(:to)---->
                                    <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger text-white shadow" data-toggle="tooltip" data-placement="top" title="Delete"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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
                    return employee.name.toLowerCase().includes(this.searchTerm.toLowerCase())
                })
            }
        },
        methods:{
            allEmployee(){
                axios.get('/api/employee/')      
                    .then(({data}) => this.employees = data)
                    .catch()
            },
            deleteEmployee(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/employee/'+id)              
                            .then(()=>{
                                this.employees = this.employees.filter(employee =>{
                                    return employee.id !=id
                                })
                            })
                            .catch(()=>{
                                this.$router.push({name: 'employee'})
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
