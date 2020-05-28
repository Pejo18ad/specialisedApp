<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header headerColor">
                <h3 class="card-title"><i class="nav-icon nav-icon fas fa-users nav-icon iconSpace"></i>Employee overview</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Add new employee <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Full Name</th>
                      <th>Contract Hours</th>
                      <th>Hiring Date</th>
                      <th>Employment Type</th>
                      <th>WP exp. Date</th>
                      <th>Primary Workplace</th>
                      <th>Comments</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users" :key="user.ID">
                      <td>{{user.id}}</td>
                      <td>{{user.name | upText}}</td>
                      <td>{{user.contract_hours}}</td>
                      <td>{{user.hiring_date | myDate}}</td>
                      <td>{{user.employment_type}}</td>
                      <td>{{user.wp_expDate | myDate}}</td>
                      <td>{{user.primary_workplace}}</td>
                      <td class="commentTable">{{user.bio}}</td>
                  
                      <td>
                        <a href="#" @click="editModal(user)">
                            <i class="fa fa-edit"></i>
                        </a>
                        /
                        <a href="#" @click="deleteEmp(user.id)">
                            <i class="fa fa-trash text-grey"></i>
                        </a>

                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            
          </div>
        </div>
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editMode" id="addNewLabel">Create new employee</h5>
                    <h5 class="modal-title" v-show="editMode" id="addNewLabel">Update employee's details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editMode ? updateUser() : createUser()">
                    <div class="modal-body">
                        <div class="form-group">
                               <input v-model="form.name" type="text" name="name"
                                placeholder="Full name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                               <input v-model="form.phone_number" type="text" name="phone_number"
                                placeholder="Phone Number"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('phone_number') }">
                            <has-error :form="form" field="phone_number"></has-error>
                        </div>
                        <div class="form-group">
                          <label class="labelNewEmployee">Date of Birth</label>
                               <input v-model="form.date_birth" type="date" name="date_birth"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('date_birth') }">
                            <has-error :form="form" field="date_birth"></has-error>
                        </div>
                        <div class="form-group">
                               <input v-model="form.nationality" type="text" name="nationality"
                                placeholder="Nationality"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('nationality') }">
                            <has-error :form="form" field="nationality"></has-error>
                        </div>
                        <div class="form-group">
                               <input v-model="form.gender" type="text" name="gender"
                                placeholder="Gender"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('gender') }">
                            <has-error :form="form" field="gender"></has-error>
                        </div>
                        <div class="form-group">
                               <input v-model="form.adress" type="text" name="adress"
                                placeholder="Adress"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('adress') }">
                            <has-error :form="form" field="adress"></has-error>
                        </div>
                        <div class="form-group">
                               <select name="primary_workplace" v-model="form.primary_workplace" id="primary_workplace" class="form-control" :class="{ 'is-invalid': form.errors.has('primary_workplace') }">
                                <option value="">Select employee primary workplace</option>
                                <option value="hotel1">Hotel 1</option>
                                <option value="hotel2">Hotel 2</option>
                                <option value="hotel3">Hotel 3</option>
                                <option value="hotel4">Hotel 4</option>
                                <option value="hotel5">Hotel 5</option>
                                <option value="hotel6">Hotel 6</option>
                                <option value="hotel7">Hotel 7</option>
                                <option value="hotel8">Hotel 8</option>
                                <option value="hotel9">Hotel 9</option>
                                <option value="hotel10">Hotel 10</option>
                                </select>
                            <has-error :form="form" field="primary_workplace"></has-error>
                        </div>
                        <div class="form-group">
                               <input v-model="form.supervisor" type="text" name="supervisor"
                                placeholder="Enter employee supervisor"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('supervisor') }">
                            <has-error :form="form" field="supervisor"></has-error>
                        </div>
                        <div class="form-group">
                               <input v-model="form.contract_hours" type="number" name="contract_hours" id="contract_hours"
                                placeholder="Employee contract hours a week"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('supervisor') }">
                            <has-error :form="form" field="contract_hours"></has-error>
                        </div>
                        <div class="form-group">
                          <label class="labelNewEmployee">Hiring Date:</label>
                               <input v-model="form.hiring_date" type="date" name="hiring_date"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('hiring_date') }">
                            <has-error :form="form" field="hiring_date"></has-error>
                        </div>
                        <div class="form-group">
                               <select name="type" v-model="form.employment_type" id="employment_type" class="form-control" :class="{ 'is-invalid': form.errors.has('employment_type') }">
                                <option value="">Select employment type</option>
                                <option value="Part-Time">Part-time</option>
                                <option value="Full-time">Full-time</option>
                                <option value="reserve">Reserve</option>
                                </select>
                            <has-error :form="form" field="employment_type"></has-error>
                        </div>
                        <div class="form-group">
                          <label class="labelNewEmployee">Work permission expiration date</label>
                               <input v-model="form.wp_expDate" type="date" name="wp_expDate"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('wp_expDate') }">
                            <has-error :form="form" field="wp_expDate"></has-error>
                        </div>
                        <div class="form-group">
                               <textarea v-model="form.bio" name="bio" id="bio"
                                placeholder="Comments for employee i.e. special needs"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                            <has-error :form="form" field="bio"></has-error>
                        </div>
                        <div class="form-group">
                               <input v-model="form.email" type="email" name="email"
                                placeholder="Email Adress"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                        </div>
                        <div class="form-group">
                               <input v-model="form.password" type="password" name="password" id="password"
                                placeholder="User Password"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
                        </div>
                        <div class="form-group">
                               <select name="permission_level" v-model="form.permission_level" id="permission_level" class="form-control" :class="{ 'is-invalid': form.errors.has('permission_level') }">
                                <option value="">Select permission level for employee</option>
                                <option value="employee">Standard employee</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="admin">Admin</option>
                                </select>
                            <has-error :form="form" field="permission_level"></has-error>
                        </div>
                        
                    </div>
                  
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button v-show="editMode" type="submit" class="btn btn-success">Update</button>
                    <button v-show="!editMode" type="submit" class="btn btn-success">Create User</button>
                </div>
                </form>
                </div>
            </div>
        </div>

    </div>


</template>

<script>
    export default {
        data() {
            return {
              editMode: false,
              users : {},
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
                   photo: ''
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },

        methods: {

          updateUser(){
            this.$Progress.start();

            this.form.put('api/user/' + this.form.id).then(()=>{

              Fire.$emit('AfterCreated');
              $('#addNew').modal('hide')

              toast.fire({
                icon: 'success',
                title: 'Employee updated successfully'
              });

            this.$Progress.finish()

            })
            .catch(() => {
              this.$Progress.fail();
              toast.fire({
                icon: 'failed',
                title: 'An error occured, did not update user'
              });
            })
          },


          editModal(user){
            this.editMode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(user);

          },


          newModal(){
            this.editMode = false;
            this.form.reset();
            $('#addNew').modal('show');
          },

          deleteEmp(id) {
              Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete!'
            }).then((result) => {

              //Send request to the server
              if(result.value) {
                  this.form.delete('api/user/' + id).then(()=>{
                      
                      Swal.fire(
                      'Deleted!',
                      'Your employee has been deleted.',
                      'success'
                    )
                      Fire.$emit('AfterCreated');

                  }).catch(()=>{
                    this.$Progress.fail();
                    toast.fire({
                      icon: 'failed',
                      title: 'An error occured, did not delete the employee'
                    });
                  });
                }
            })
          },

          loadUsers(){
            axios.get("api/usersShowAll").then(({ data }) => (this.users = data));
          },

          createUser(){
            this.$Progress.start();

            this.form.post('api/user')
            .then(()=>{
              Fire.$emit('AfterCreated');

             $('#addNew').modal('hide')

              toast.fire({
                icon: 'success',
                title: 'Employee created successfully'
              });

            this.$Progress.finish();

            })
            .catch(()=>{
              this.$Progress.fail();
              toast.fire({
                icon: 'failed',
                title: 'An error occured, did not create the employee'
              });

            })

            
          }
        },

        created() {
            this.loadUsers();
            Fire.$on('AfterCreated',() => {
              this.loadUsers();
            });
        }
    }
</script>
