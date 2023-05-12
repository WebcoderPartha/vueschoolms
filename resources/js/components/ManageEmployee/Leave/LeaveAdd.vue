<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Leave</h1>
          </div><!-- /.col -->


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <form @submit.prevent="storeData" ref="clearForm">
        <div class="row">

          <div class="col-md-6 mx-auto">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add Leave</h3>
              </div>
              <div class="card-body">

                  <div class="row">
                    <div class="col-md-12">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Employee</span>
                        </div>
                        <select class="form-control" v-model="form.employee_id">
                          <option value="">Select Employee</option>
                          <option v-for="(employee, index) in employees" :value="employee.id" :key="index+1">{{ employee.name }}</option>
                        </select>
                      </div>

<!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div><!-- end Col-12 --->

                    <div class="col-md-12">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Leave Purpose</span>
                        </div>
                        <select class="form-control" @change="newPurpose" v-model="form.leave_purpose_id">
                          <option value="">Select purpose</option>
                          <option v-for="(leavePurpose, index) in leavePurposes" :value="leavePurpose.id" :key="index+1">{{ leavePurpose.leave_purpose }}</option>
                          <option value="new_purpose">New Purpose</option>
                        </select>
                      </div>
                    </div><!-- end Col-12 --->
                    <div class="col-md-12 newPurpose" style="display: none">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">New Purpose</span>
                        </div>
                        <input type="text" class="form-control" v-model="form.add_new_purpose">
                      </div>
                    </div><!-- end Col-6 --->
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Leave Start Date</span>
                        </div>
                        <input type="date" class="form-control" v-model="form.leave_start_date">
                      </div>
                    </div><!-- end Col-6 --->
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Leave End Date</span>
                        </div>
                        <input type="date" class="form-control" v-model="form.leave_end_date">
                      </div>
                    </div> <!-- end Col-6 --->
                  </div>


                <button type="submit" :to="{name:'shift'}" class="btn btn-info">Add Leave</button>
                <router-link :to="{name:'leave'}" class="btn btn-danger float-right">Back</router-link>
              </div>

              <!-- /.card-body -->
            </div>
          </div>

        </div><!-- /.row -->

        </form>

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>


export default {
  name: "LeaveAdd",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getEmployee();
    this.getLeavePurpose();
  },
  data(){
    return {
      form: {
        employee_id: '',
        leave_purpose_id: '',
        add_new_purpose: '',
        leave_start_date: '',
        leave_end_date: ''
      },
      employees: [],
      leavePurposes: [],
      errors: []

    }
  },
  methods:{
    pageTitle(){
      document.title = "Add Leave"
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },
    getEmployee(){
      axios.get('/employee').then(res=> this.employees = res.data)
    },
    getLeavePurpose(){
      axios.get('/leavepurpose').then(res=> this.leavePurposes = res.data)
    },
    newPurpose(e){
      let newPurpose = e.target.value;
      if (newPurpose === 'new_purpose'){
        document.getElementsByClassName('newPurpose')[0].style.display = 'block'
      }else{
        document.getElementsByClassName('newPurpose')[0].style.display = 'none'
        this.form.add_new_purpose = ''
      }
    },
    storeData(){
      if (!this.validateData()){
        axios.post('/leave', this.form)
            .then(response => {
              this.$router.push({name: 'leave'})
              this.$refs.clearForm.reset()
              Notification.success(response.data)
            }).catch(error => {
          this.errors = error.response.data.errors
        })
      }
    },
    validateData(){
      if (!this.form.employee_id > 0 || !this.form.leave_purpose_id > 0 || !this.form.leave_start_date > 0 || !this.form.leave_end_date > 0){
        Notification.warning('Field must not be empty!')
        return true
      }
    }

  } // End Method
}
</script>

<style scoped>

</style>