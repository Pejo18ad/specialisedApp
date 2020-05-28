
<template>
    <div class="container">
        <div class="row mt-3">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header headerColor">
                <h3 class="card-title"><i class="nav-icon nav-icon fas fa-table nav-icon iconSpace"></i>Timesheets</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Add new workday <i class="fas fa-calendar-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 ">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Employee ID</th>
                      <th>Date</th>
                      <th>Start</th>
                      <th>End</th>
                      <th>Break</th>
                      <th>Hours worked</th>
                      <th>Workplace</th>
                      <th>Comments</th>
                      <th>Approval status</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="timeregistration in timeregistration" :key="timeregistration.ID">
                      <td>{{timeregistration.user_id}}</td>
                      <td>{{timeregistration.date}}</td>
                      <td>{{timeFormat(timeregistration.check_in)}}</td>
                      <td>{{timeFormat(timeregistration.check_out)}}</td>
                      <td>{{timeregistration.break_time}} minutes</td>
                      <td>{{ hours_worked(timeregistration.check_in, timeregistration.check_out, timeregistration.break_time) }}</td>
                      <td>{{timeregistration.worked_hotel}}</td>
                      <td>{{timeregistration.comments}}</td>
                      <td>
                        <i class="fa fa-history approvedIcon3" v-if="timeregistration.approval_status === 0"></i>
                        <i class="fa fa-check approvedIcon2" v-if="timeregistration.approval_status === 1"></i>
                        <i class="fa fa-times approvedIcon1" v-if="timeregistration.approval_status === 2"></i>
                      </td>
                                       
                      <td>
                        <a href="#" @click="editModal(timeregistration)">
                            <i class="fa fa-edit"></i>
                        </a>
                        /
                        <a href="#" @click="deleteTime(timeregistration.id)">
                            <i class="fa fa-trash text-grey"></i>
                        </a>

                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
             <div class="card-footer headerColor">
               Showing the last 10 time registrations
             </div>
            </div>
            
          </div>
        </div>
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editMode" id="addNewLabel">Add workday</h5>
                    <h5 class="modal-title" v-show="editMode" id="addNewLabel">change workday details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editMode ? updateWorkday() : createTimeregistration()">
                    <div class="modal-body">
                        <div class="form-group">
                          <label class="labelNewEmployee">Date of workday</label>
                               <input v-model="form.date" type="date" name="date" id="today"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('date') }">
                            <has-error :form="form" field="date"></has-error>
                        </div>
                        <div class="form-group">
                          <label class="labelNewEmployee">Check in time</label>
                               <input v-model="form.check_in" type="time" name="check_in" id="check_in"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('check_in') }">
                            <has-error :form="form" field="check_in"></has-error>
                        </div>
                        <div class="form-group">
                          <label class="labelNewEmployee">Check out time</label>
                               <input v-model="form.check_out" type="time" name="check_out" id="check_out"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('check_out') }">
                            <has-error :form="form" field="check_out"></has-error>
                        </div>
                        <div class="form-group">
                               <select name="break_time" v-model="form.break_time" id="break_time" class="form-control" :class="{ 'is-invalid': form.errors.has('break_time') }">
                                <option value="">Select break time in minutes</option>
                                <option type="time" value="0">No Break</option>
                                <option type="time" value="15">15 Minutes</option>
                                <option type="time" value="30">30 Minutes</option>
                                <option type="time" value="45">45 Minutes</option>
                                <option type="time" value="60">60 Minutes</option>
                                </select>
                            <has-error :form="form" field="break_time"></has-error>
                        </div>
                        <div class="form-group">
                               <textarea v-model="form.comments" name="comments" id="comments"
                                placeholder="Comments for workday"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('comments') }"></textarea>
                            <has-error :form="form" field="comments"></has-error>
                        </div>
                        <div class="form-group">
                               <select name="primary_workplace" v-model="form.worked_hotel" id="worked_hotel" placeholder="Select" class="form-control" :class="{ 'is-invalid': form.errors.has('worked_hotel') }">
                                <option selected>Select workplace</option>
                                <option value="Hotel 1">Hotel 1</option>
                                <option value="Hotel 2">Hotel 2</option>
                                <option value="Hotel 3">Hotel 3</option>
                                <option value="Hotel 4">Hotel 4</option>
                                <option value="Hotel 5">Hotel 5</option>
                                <option value="Hotel 6">Hotel 6</option>
                                <option value="Hotel 7">Hotel 7</option>
                                <option value="Hotel 8">Hotel 8</option>
                                <option value="Hotel 9">Hotel 9</option>
                                <option value="Hotel 10">Hotel 10</option>
                                </select>
                            <has-error :form="form" field="primary_workplace"></has-error>
                        </div>
                      </div>
                  
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button v-show="editMode" type="submit" class="btn btn-success">Update workday</button>
                    <button v-show="!editMode" type="submit" class="btn btn-success">Add workday</button>
                </div>
                </form>
                </div>
            </div>
        </div>

    </div>


</template>

<script>
import moment from 'moment';
    export default {
        data() {
            return {
              editMode: false,
              timeregistration : {},
                form: new Form({
                   id: '',
                   date : '',
                   check_in: '',
                   check_out: '',
                   break_time: '',
                   hours_worked: '',
                   comments: '',
                   worked_hotel: '',
                   approval_status: '',
                   user_id: '',
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            hours_worked(start, end, break_time) {

              // parse time using 24-hour clock and use UTC to prevent DST issues
              start = moment.utc(start, "HH:mm");
              end = moment.utc(end, "HH:mm");


              // account for crossing over to midnight the next day
              if (end.isBefore(start)) end.add(1, 'day');

              // calculate the duration
              var d = moment.duration(end.diff(start));

              // subtract the lunch break
              d.subtract(break_time, 'minutes');

              // format a string result
              var s = moment.utc(+d).format('H:mm');
              this.form.hours_worked = s;
              
              
              return s;
            },

            timeFormat(timeValue) {
              timeValue = moment.utc(timeValue, "HH:mm").format('HH:mm');
              return timeValue;
            },



          updateWorkday(){
            this.$Progress.start();

            var start = this.form.check_in;
                var end = this.form.check_out;
                var lunch = this.form.break_time;
              // parse time using 24-hour clock and use UTC to prevent DST issues
              start = moment.utc(start, "HH:mm");
              end = moment.utc(end, "HH:mm");

              // account for crossing over to midnight the next day
              if (end.isBefore(start)) end.add(1, 'day');

              // calculate the duration
              var d = moment.duration(end.diff(start));

              // subtract the lunch break
              d.subtract(lunch, 'minutes');

              // format a string result
              var s = moment.utc(+d).format('H:mm');
              this.form.hours_worked = s;

            this.form.put('api/timeregistration/' + this.form.id).then(()=>{

              Fire.$emit('AfterCreated');
              $('#addNew').modal('hide')
              
              toast.fire({
                icon: 'success',
                title: 'Workday updated successfully'
              });

            this.$Progress.finish()

            })
            .catch(() => {
              this.$Progress.fail();
              toast.fire({
                icon: 'failed',
                title: 'An error occured, did not update workday'
              });
            })
          },


          editModal(timeregistration){
            this.editMode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(timeregistration);

          },


          newModal(){
            this.editMode = false;
            this.form.reset();
            $('#addNew').modal('show');
          },

          deleteTime(id) {
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
                  this.form.delete('api/timeregistration/' + id).then(()=>{
                      
                      Swal.fire(
                      'Deleted!',
                      'Your timeregistration has been deleted.',
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

          loadTimeregistration(){
            axios.get("api/timeregistrationShow").then(({ data }) => (this.timeregistration = data));
          },

          createTimeregistration(){
            this.$Progress.start();

                var start = this.form.check_in;
                var end = this.form.check_out;
                var lunch = this.form.break_time;
              // parse time using 24-hour clock and use UTC to prevent DST issues
              start = moment.utc(start, "HH:mm");
              end = moment.utc(end, "HH:mm");

              // account for crossing over to midnight the next day
              if (end.isBefore(start)) end.add(1, 'day');

              // calculate the duration
              var d = moment.duration(end.diff(start));

              // subtract the lunch break
              d.subtract(lunch, 'minutes');

              // format a string result
              var s = moment.utc(+d).format('H:mm');
              this.form.hours_worked = s;
              this.form.approval_status = '0';


            this.form.post('api/timeregistration')
            .then(()=>{
              Fire.$emit('AfterCreated');

             $('#addNew').modal('hide')

              toast.fire({
                icon: 'success',
                title: 'Workday created successfully'
              });

            this.$Progress.finish();

            })
            .catch(()=>{
              this.$Progress.fail();
              toast.fire({
                icon: 'failed',
                title: 'An error occured, did not create workday'
              });

            })

            
          }
        },
        created() {
            this.loadTimeregistration();
            Fire.$on('AfterCreated',() => {
              this.loadTimeregistration();
            });
        },
        
    }
</script>
