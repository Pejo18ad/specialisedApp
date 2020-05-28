<template>
    <div class="container">
        <div class="row">
          <div class="col-md-3 mt-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline borderTop">
              <div class="card-body box-profile">
                <div class="text-center ">
                  <img class="profile-user-img img-fluid img-circle " v-bind:src="getProfilePhoto()" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center ">{{this.form.name}}</h3>

                <p class="text-muted text-center ">{{this.form.position}}</p>

                <ul class="list-group list-group-unbordered mb-3 " >
                  <li class="list-group-item center alignCenter ">
                    <label class="custom-file-upload ">
                        <input type="file" @change="updateProfile" name="photo"/>
                        <i class="fa fa-cloud-upload-alt "></i> Change photo
                    </label>
                    <br>
                    <button @click.prevent="updateInfo" type="submit" class="btn btn-sm ">Update photo</button>
                    <P class="saveMessage">{{this.form.message}}</P>
                  </li>

                  
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header headerColor">
                <h3 class="card-title ">Quick info</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-id-badge iconSpace"></i>Employee ID</strong>

                <p class="text-muted quickInfo">
                  {{this.form.id}}
                </p>

                <hr>

                <strong><i class="fas fa-hotel mr-1"></i>Primary Workplace</strong>

                <p class="text-muted quickInfo"> {{this.form.primary_workplace}}</p>

                <hr>

                <strong><i class="fas fa-file-signature mr-1"></i>Contract Hours</strong>

                <p class="text-muted quickInfo">{{this.form.contract_hours}} Hours per week
                </p>

                <hr>

                <strong><i class="fas fa-user-tie mr-1"></i>Supervisor</strong>

                <p class="text-muted quickInfo">{{this.form.supervisor}}</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9 mt-3">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><h3 class="card-title">
                  <i class="fas fa-id-badge iconSpace"></i>Personal Details</h3></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputFullName" class="col-sm-2 col-form-label">Full name</label>
                        <div class="col-sm-10">
                          <input readonly  type="text" v-model="form.name" class="form-control disabled" id="inputFullName" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPhoneNumber" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                          <input readonly v-model="form.phone_number" type="text" class="form-control disabled" id="inputPhoneNumber" placeholder="Phone Number">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputBirthday" class="col-sm-2 col-form-label">Birthday</label>
                        <div class="col-sm-10">
                          <input readonly v-model="form.date_birth" type="date" class="form-control disabled" id="inputBirthday" placeholder="Birthday">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputNationality" class="col-sm-2 col-form-label">Nationality</label>
                        <div class="col-sm-10">
                          <input readonly v-model="form.nationality" type="text" class="form-control disabled" id="inputNationality" placeholder="Nationality">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                          <input readonly  v-model="form.gender" type="text" class="form-control disabled" id="inputGender" placeholder="Gender">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputAdress" class="col-sm-2 col-form-label">Adress</label>
                        <div class="col-sm-10">
                          <input readonly v-model="form.adress" type="text" class="form-control disabled" id="inputAdress" placeholder="Adress">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Short decription</label>
                        <div class="col-sm-10">
                          <textarea readonly v-model="form.bio" class="form-control disabled" id="inputExperience" placeholder="Short description"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="form-control information">
                            <label >
                              Details only editable by the administration, please click "report wrong information" below
                                if any of the details is incorrect 
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Report wrong information</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
                          <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><h3 class="card-title">
                  <i class="fas fa-file-signature iconSpace"></i>Contract Details</h3></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputEmpId" class="col-sm-2 col-form-label">Employee ID</label>
                        <div class="col-sm-10">
                          <input readonly v-model="form.id" type="text" class="form-control disabled" id="inputEmpId" placeholder="Employee ID">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPrimaryWorkplace" class="col-sm-2 col-form-label fontInformation">Primary workplace</label>
                        <div class="col-sm-10">
                          <input readonly v-model="form.primary_workplace" type="text" class="form-control disabled" id="inputPrimaryWorkplace" placeholder="Primary workplace">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSupervisor" class="col-sm-2 col-form-label">Supervisor</label>
                        <div class="col-sm-10">
                          <input readonly v-model="form.supervisor" type="text" class="form-control disabled" id="inputSupervisor" placeholder="Supervisor">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputContractHours" class="col-sm-2 col-form-label">Contract hours</label>
                        <div class="col-sm-10">
                          <input readonly v-model="form.contract_hours" type="text" class="form-control disabled" id="inputContractHours" placeholder="Contract hours">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputHiringDate" class="col-sm-2 col-form-label">Hiring date</label>
                        <div class="col-sm-10">
                          <input readonly v-model="form.hiring_date" type="date" class="form-control disabled" id="inputHiringDate" placeholder="Hiring date">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmploymentType" class="col-sm-2 col-form-label fontInformation">Employment type</label>
                        <div class="col-sm-10">
                          <input readonly v-model="form.employment_type" type="text" class="form-control disabled" id="inputEmploymentType" placeholder="Employment type">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputWpExpDate" class="col-sm-2 col-form-label fontInformation">Work permit exp. Date</label>
                        <div class="col-sm-10">
                          <input readonly v-model="form.wp_expDate" type="date" class="form-control disabled" id="inputWpExpDate" placeholder="Work permit exp. Date">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label fontInformation">Position</label>
                        <div class="col-sm-10">
                          <input readonly v-model="form.position" type="text" class="form-control disabled" id="inputPosition" placeholder="Position">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Short decription</label>
                        <div class="col-sm-10">
                          <textarea readonly v-model="form.bio" class="form-control disabled" id="inputExperience" placeholder="Short description"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="form-control information">
                            <label >
                              Details only editable by the administration, please click "report wrong information" below
                                if any of the details is incorrect 
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Report wrong information</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>

</template>

<script>
    export default {
        data() {
            return {
              currentPhoto:"",
                form: new Form({
                   id: '',
                   name : '',
                   phone_number: '',
                   date_birth: '',
                   nationality: '',
                   gender: '',
                   adress: '',
                   primary_workplace: '',
                   supervisor: '',
                   contract_hours: '',
                   hiring_date: '',
                   employment_type: '',
                   position: '',
                   wp_expDate: '',
                   bio: '',
                   email: '',
                   password: '',
                   permission_level: '',
                   photo: '',
                   message: ''
                })
            }
        },

        mounted() {
            console.log('Component mounted.')
        },

        methods:{

          getProfilePhoto(){
            let prefix = (this.form.photo.match(/\//) ? '' : '/img/profile/');
            return prefix + this.form.photo;
          },

          updateInfo(){
              this.$Progress.start()
              this.form.put('api/profile')
              .then(() => {
                this.form.message = "";
                Fire.$emit('AfterCreated');
                toast.fire({
                icon: 'success',
                title: 'Photo uploaded and saved successfully'
                
              });
                location.reload();
                
                this.$Progress.finish()
                //Toaster from Sweet Alert
                  
              })
              .catch(() => {
                this.$Progress.fail()

              })
            },

          updateProfile(e){
            let file = e.target.files[0];
            let reader = new FileReader();
            
            reader.onloadend = (file) => {
              
              //console.log('RESULT', reader.result)
              this.form.photo = reader.result;
              this.form.message = "Press update photo to save changes"
              
              
             }
             reader.readAsDataURL(file);
          }

        },


        created() {
          this.$Progress.start()
            axios.get('api/profile')
            .then(({ data }) => {
              this.userPhoto = "img/profile/" + data.photo;
              Fire.$on('AfterUpdate', () => {
                axios.get('api/profile')
                .then((data) => {
                  let photo = data.data.photo
                  this.userPhoto = "img/profile/" + photo;
                })
              })
              this.form.reset();
              this.form.fill(data)
              this.$Progress.finish();
            })
            .catch(() => {
              this.$Progress.fail();
            })
        }
  }

</script>

