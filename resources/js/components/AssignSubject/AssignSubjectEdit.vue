<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Assign Subject</h1>
          </div><!-- /.col -->


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <form @submit.prevent="updateData">
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-6 mx-auto">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Edit Assign Subject</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-10">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Class</span>
                        </div>
                        <select class="form-control" v-model="form.class_id" @change="ClassEvent">
                          <option value="">Select class</option>
                          <option v-for="cls in classes" :key="cls.id" :value="cls.id">{{ cls.name }}</option>
                        </select>
                      </div>

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-10">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Subject</span>
                        </div>
                        <select class="form-control" v-model="add_subject_id">
                          <option value="">Select subject</option>
                          <option v-for="subject in subjects" :key="subject.id" :value="subject.id">{{ subject.name }}</option>
                        </select>
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div>
                    <div class="col-md-2">
                      <button @click.prevent="addItem" class="btn btn-sm btn-primary">+</button>

                    </div>
                  </div>
                  <router-link :to="{name:'assignsubject'}" class="btn btn-danger">Back</router-link>


                </div>

                <!-- /.card-body -->
              </div>
            </div>
            <div class="col-md-1"></div>
          </div>
          <div class="row">

            <div class="col-md-6 mx-auto">
              <div class="card">
                <div class="card-header">
                  <!--                  {{subject_name}}        {{class_names}}-->
                  <h4 class="text-center">Updatable Data</h4>
                  <hr>
                  <h5 class="text-center">{{ class_name}}</h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 mx-auto" >
                      <table class="table-bordered table">
                        <tr v-for="(subject,index) in subject_names" :key="index">
                          <td>{{ subject }} &nbsp; || &nbsp;      <button @click.prevent="removeItem(index)" class="btn btn-sm btn-danger">-</button></td>
                        </tr>

                      </table>
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-2" disabled v-if="this.form.class_id.length === 0 || this.subject_names.length === 0">Update Listed</button>
                    <button type="submit" class="btn btn-primary mt-2" v-else>Update Listed</button>
                  </div>

                </div>

                <!-- /.card-body -->
              </div>
            </div>

          </div>
        </form>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>


export default {
  name: "AssignSubjectEdit",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getClass();
    this.getSubject();
    this.getAssignSubjectById();

  },
  computed:{

  },
  data(){
    return {
      form: {
        class_id: '',
        subject_id: []
      },
      subjects: [],
      classes: [],
      add_subject_id: '',
      errors: [],
      class_name: '',
      subject_names: [],
    }
  },
  methods:{

    pageTitle(){
      document.title = 'Add Assign Subject'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },
    addItem(){

      if (!this.validateData()){
        this.form.subject_id.push(this.add_subject_id);
        axios.get('/subject/'+this.add_subject_id).then(res => {
          this.subject_names.push(res.data.name)
        });

        if (this.form.subject_id.indexOf(this.add_subject_id) !== this.form.subject_id.lastIndexOf(this.add_subject_id)){
          Notification.error('Should not be Duplicate data!')
        }

        this.form.subject_id = [...new Set(this.form.subject_id)]

        axios.get('/subject/'+this.add_subject_id).then(res => {
          this.subject_names = [...new Set(this.subject_names)]
        });

        this.add_subject_id = ''
      }

    },
    removeItem(index){
      this.form.subject_id.splice(index, 1);
      this.subject_names.splice(index, 1);
    },
    ClassEvent(e){
      this.form.class_id = e.target.value
      axios.get('/class/'+e.target.value).then(res => this.class_name = res.data.name)
    },
    getClass(){
      axios.get('/class').then(res => this.classes = res.data)
    },
    getSubject(){
      axios.get('/subject').then(res => this.subjects = res.data)
    },
    getAssignSubjectById(){
      axios.get('/assignsubject/'+this.$route.params.id)
          .then(response => {
            // class name
            this.class_name = response.data[0].student_class.name;
            // class id
            this.form.class_id = response.data[0].student_class.id
            let subjectNameArray = [];
            let subjectIdArray = [];
            let subjects = response.data;
            subjects.forEach(subject => {
              subjectNameArray.push(subject.subject.name);
              subjectIdArray.push(subject.subject.id)
            })
            // Subject names
            this.subject_names = subjectNameArray
            this.form.subject_id = subjectIdArray;

          }).catch(error => {
      })
    },
    updateData(){

      axios.put('/assignsubject/'+this.$route.params.id, this.form)
          .then(response => {
            this.$router.push({name: 'assignsubject'})
            Notification.success(response.data);
          }).catch(error => {
        this.errors = error.response.data.errors
      })

    },
    validateData(){
      if (this.form.class_id.length === 0 || this.add_subject_id.length === 0){
        Notification.error('Field must not be empty!')
        return true;
      }
    }

  } // End Method
}
</script>

<style scoped>

</style>