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
                    <th>Joining Date</th>
                    <th>Salary</th>

                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(salary, index) in salaries" :key="index+1">
                    <td>{{ salary.id_number }}</td>
                    <td>{{ salary.name }}</td>
                    <td>{{ salary.joining_date }}</td>
                    <td>{{ salary.salary }}</td>

                    <td>
                      <RouterLink :to="{name: 'salaryincrement', params:{id:salary.id}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Increment</RouterLink>&nbsp;
<!--                      <RouterLink :to="{name: 'studentdetail', params:{id:student.student_id}}" class="badge bg-primary"><i class="fa fa-eye"></i></RouterLink>-->
                      &nbsp;<button  class="badge bg-danger"><i class="fa fa-trash-alt"></i></button>
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
  },
  methods:{


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
      axios.get('/employee').then(res => {

        this.salaries = res.data;
      })
    },

  } // End Method
}
</script>

<style scoped>

</style>