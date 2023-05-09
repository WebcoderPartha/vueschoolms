<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Salary List</h1>
          </div><!-- /.col -->


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-md-10 mx-auto">
            <div class="card">
              <div class="card-header">
                <h3>Salary List <RouterLink :to="{name:'dashboard'}" class="btn btn-primary float-right">Back</RouterLink></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" v-show="salaries.length > 0">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Year</th>
                    <th>Class</th>
                    <th>Roll</th>
                    <th>Image</th>
                    <th><input type="checkbox" v-model="selectAll"> Select All
                      <button class="btn btn-sm btn-danger" @click="deleteAll" v-show="checkBox.length > 0"><i class="fa fa-trash-alt"></i></button>
                    </th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(salary, index) in salaries" :key="index+1">
                    <td>{{ salary.employee.id_number }}</td>
                    <td>{{ salary.employee.name }}</td>
                    <td>{{ salary.previous_salary }}</td>
                    <td>{{ salary.present_salary }}</td>
                    <td>{{ salary.inrement_salary }}</td>
                    <td>{{ salary.inrement_salary_date }}</td>
                    <td>

                      <input type="checkbox" :value="student.student_id" v-model="checkBox">


                    </td>
                    <td>
                      <RouterLink :to="{name: 'salaryincrement', params:{id:salary.employee_id}}" class="badge bg-info"><i class="fa fa-edit"></i></RouterLink>&nbsp;
<!--                      <RouterLink :to="{name: 'studentdetail', params:{id:student.student_id}}" class="badge bg-primary"><i class="fa fa-eye"></i></RouterLink>-->
                      &nbsp;<button @click="deleteData(salary.id)"  class="badge bg-danger"><i class="fa fa-trash-alt"></i></button>
                    </td>
                  </tr>

                  </tbody>
                </table>
                <h3 class="text-center" v-show="!salaries.length > 0">No data found!</h3>
              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->

          </div>


        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>


export default {
  name: "EmployeeSalaryList",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getSalary();
  },

  data(){
    return {

      salaries: [],
      checkBox: [],

    }
  },
  computed: {
    selectAll: {
      get:function (){
        return this.salaries ? this.salaries.length === this.checkBox.length : false
      },
      set: function (value){

        let arrayValue = [];
        if (value){
          this.salaries.forEach(salary => {
            arrayValue.push(salary.id)
          });
        }

        this.checkBox = arrayValue;

      }
    }
  },
  methods:{
    deleteAll(){

      Swal.fire({
        title: 'Are you sure?',
        // text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          let data = {
            checkBox: this.checkBox
          }
          axios.post('/salary/alldel', data).then(res => {
            this.getSalary();
            this.checkBox = []
            Notification.success(res.data);
          })
          Swal.fire(
              'Deleted!',
              // 'Your file has been deleted.'+ id,
              'success'
          )
        }
      })

    },

    deleteData(id){

      Swal.fire({
        title: 'Are you sure?',
        // text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/salary/'+id).then(res => {
            this.getSalary()
          })
          Swal.fire(
              'Deleted!',
              // 'Your file has been deleted.'+ id,
              'success'
          )
        }
      })
    },

    pageTitle(){
      document.title = 'Salary list'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },

    getSalary(){
      axios.get('/salary').then(res => {

        this.salaries = res.data;
      })
    },

  } // End Method
}
</script>

<style scoped>

</style>