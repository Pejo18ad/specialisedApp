
<template>

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 mt-3">
                <div class="card">
                    <div class="card-header headerColor">Add your working day</div>

                    <div class="card-body">
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                          <label class="labelNewEmployee">Date of workday</label>
                               <input v-model="form.date" type="date" name="date" id="today"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('date') }">
                            <has-error :form="form" field="date"></has-error>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <label class="labelNewEmployee">Check in time</label>
                                <input v-model="form.check_in" type="time" name="check_in" id="check_in"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('check_in') }">
                                <has-error :form="form" field="check_in"></has-error>
                                </div>
                                <div class="col mb-3">
                                <label class="labelNewEmployee">Check out time</label>
                               <input v-model="form.check_out" type="time" name="check_out" id="check_out"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('check_out') }">
                            <has-error :form="form" field="check_out"></has-error>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="labelNewEmployee">Lunch time</label>
                               <select name="break_time" v-model="form.break_time" id="break_time" class="form-control mt-1" :class="{ 'is-invalid': form.errors.has('break_time') }">
                                <option value="">Select break time in minutes</option>
                                <option type="time" value="0">No Break</option>
                                <option type="time" value="15">15 Minutes</option>
                                <option type="time" value="30">30 Minutes</option>
                                <option type="time" value="45">45 Minutes</option>
                                <option type="time" value="60">60 Minutes</option>
                                </select>
                            <has-error :form="form" field="break_time"></has-error>
                        </div>
 <!---                       <div class="form-group">
                               <input v-model="form.hours_worked" type="text" name="hours_worked" id="hours_worked" readonly
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
--->
                        <div class="form-group">
                            <label class="labelNewEmployee">Comments from workday (overtime etc.)</label>
                               <textarea v-model="form.comments" name="comments" id="comments"
                                placeholder="Comments for workday"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('comments') }"></textarea>
                            <has-error :form="form" field="comments"></has-error>
                        </div>
                            <div class="form-group">
                                <label class="labelNewEmployee">Select workplace</label>
                                <select name="primary_workplace" v-model="form.worked_hotel" id="worked_hotel" class="form-control" :class="{ 'is-invalid': form.errors.has('worked_hotel') }">
                                    <option value="">Select workplace </option>
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
                            </form>
                        </div>
                        <div class="modal-footer addWorkdayButtonCenter">
                        <button @click="createTimeregistration()" class="btn btn-success">Add workday <i class="fas fa-calendar-plus fa-fw"></i></button>
                    </div>
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


          updateWorkday(){
            this.$Progress.start();

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

          loadTimeregistration(){
            axios.get("api/timeregistration").then(({ data }) => (this.timeregistration = data.data));
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


            this.form.post('api/timeregistration')
            .then(()=>{

                Swal.fire(
                      'Created!',
                      'You have worked: ' + s + ' hours today,  it has now been saved.',
                      'success'
                    );

            this.form.reset();
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

    }
</script>
