<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Attendance Edit</h1>
          </div><!-- /.col -->


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <form  @submit.prevent="updateData" ref="cleardata">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-header text-center">
                  <h4> Employee Attendance</h4>

                  <!--                ${current.getDate()}/${current.getMonth()+1}/${current.getFullYear()}`-->

                  <hr>
                  <div class="form-group col-4 mx-auto ">
                    <label for="date"> <b>Attendance Date</b></label>
                    <input type="date" name="date" id="date" v-model="attendance_date" class="form-control">
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-respnsive text-center">
                    <table class="table table-bordered">
                      <tbody><tr>
                        <td rowspan="2">SL</td>
                        <td rowspan="2">Employee ID</td>
                        <td rowspan="2">Employee Name</td>
                        <td colspan="3">Attendance Status</td>
                      </tr>
                      <tr bgcolor="#00c8bf" style="color: #fff !important;">
                        <td>Present</td>
                        <td>Absent</td>
                        <td>Leave</td>
                      </tr>
                      <tr v-for="(employee,index) in employees" :key="employee.id">
                        <td>{{index+1}}</td>
                        <td>{{ employee.employee.id_number }}</td>
                        <td>{{ employee.employee.name }}</td>
                        <td>
                          <div class="form-group">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input v-if="employee.attendance_status === 'Present'" checked :data-employee-id="employee.employee.id" :id="`employee-${employee.employee.id}`" :data-attendance-date="attendance_date" :name="employee.employee.id" @change="AttendantEvent" type="radio" class="form-check-input checkbox" value="Present">
                                <input v-else :data-employee-id="employee.employee.id" :id="`employee-${employee.employee.id}`" :data-attendance-date="attendance_date" :name="employee.employee.id" @change="AttendantEvent" type="radio" class="form-check-input checkbox" value="Present">
                                Present
                              </label>
                            </div>

                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input v-if="employee.attendance_status === 'Absent'" checked type="radio" :data-employee-id="employee.employee.id" :id="`employee-${employee.employee.id}`" :data-attendance-date="attendance_date" :name="employee.employee.id" @change="AttendantEvent" class="form-check-input checkbox" value="Absent">
                                <input v-else type="radio" :data-employee-id="employee.employee.id" :id="`employee-${employee.employee.id}`" :data-attendance-date="attendance_date" :name="employee.employee.id" @change="AttendantEvent" class="form-check-input checkbox" value="Absent">
                                Absent
                                <i class="input-helper"></i></label>
                            </div>

                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input v-if="employee.attendance_status === 'Leave'" checked type="radio" :data-employee-id="employee.employee.id" :id="`employee-${employee.employee.id}`" id="checkboxes" :data-attendance-date="attendance_date" :name="employee.employee.id"  @change="AttendantEvent" class="form-check-input checkbox" value="Leave">
                                <input v-else type="radio" :data-employee-id="employee.employee.id" :id="`employee-${employee.employee.id}`" id="checkboxes" :data-attendance-date="attendance_date" :name="employee.employee.id"  @change="AttendantEvent" class="form-check-input checkbox" value="Leave">
                                Leave
                                <i class="input-helper"></i></label>
                            </div>

                          </div>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="form-group text-center mt-4">
                    <input class="btn btn-primary" type="submit" value="Update Attendance">
                  </div>
                </div>

              </div>

            </div>

          </div> <!-- End Row-->
        </form>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>


export default {
  name: "AttendanceAdd",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getEmployee();
    // this.currentDate();

  },
  data(){
    return {
      form: [

      ],
      attendance_date:'',
      employees: [],
    }
  },
  methods:{

    // currentDate(){
    //   let getDate = new Date()
    //   this.attendance_date = moment(getDate).format('YYYY-MM-D')
    // },

    AttendantEvent(e){
      if (!this.validateDate()){
        let data = {
          employee_id: e.target.getAttribute('data-employee-id'),
          attendance_status: e.target.value,
          attendance_date: e.target.getAttribute('data-attendance-date')
        }

        this.form.push(data)

        // Unique Object Array
        this.form = [...new Map(this.form.map(item=> [item['employee_id'],item])).values()]

      }
    },
    updateData(){
      if (this.form.length > 0){
        let data = {
          form: this.form
        }

        axios.put('/attendance/'+this.$route.params.id,data).then(response => {
          if (response.status === 200){
            this.$refs.cleardata.reset()
            this.$router.push({name: 'attendance'})
            Notification.success(response.data)
          }
        }).catch(error => {

        })

      }else{
        Notification.error('Field must not be empty!')
      }
    },
    getEmployee(){
      axios.get('/attendance/'+this.$route.params.id).then(res => {

        this.attendance_date = res.data[0].attendance_date
        this.employees = res.data
        let Array = []
        res.data.forEach(item => {
          let data = {
            employee_id: item.employee_id.toString(),
            attendance_status: item.attendance_status,
            attendance_date: item.attendance_date,
          }
          Array.push(data)
        })
        this.form = Array
      })
    },
    pageTitle(){
      document.title = 'Add Attendance'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },

    validateDate(){

      if (this.attendance_date.length === 0){

        Notification.error('Select date first!');

        for(let i = 0; i < document.getElementsByClassName("checkbox").length; i++){

          document.getElementsByClassName('checkbox')[i].checked = false;

        }
        return true
      }

    }

  } // End Method
}
</script>

<style scoped>

</style>