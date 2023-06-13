<template>
	<div class="card">
      <!-- <div class="avatar avatar-md mr-3" style="background-image: url(/tabler/demo/faces/male/16.jpg)"></div> -->
      <span class="m-2 row">
      	<div class="col-md-8">
      		<a href="#" @click.prevent="takeAction('complete')" class="btn btn-success mr-2">Complete</a>
      		<a href="#" @click.prevent="takeAction('discard')" class="btn btn-danger" v-if="create_schedule">Discard</a>
      	</div>
      	<div class="col-md-4 text-right">
      		<a href="#" class="btn btn-primary mr-2" title="Close" @click.prevent="$emit('edit-schedule')" v-if="create_schedule">Edit</a>
      		<a href="#" class="btn btn-sm btn-danger mr-2" title="Close" @click.prevent="deleteMasterSchedule(display.id)">Delete</a>
      		<a href="#" class="btn btn-default" title="Close" @click.prevent="$emit('unfocus')">Close</a>
      	</div>
        <!-- <a href="#" @click.prevent="toggleEditSchedule()" title="Edit">Edit</a> -->
        <!-- <a href="#" @click.prevent="deleteMasterSchedule(display.schedule_id)" title="Delete">Delete</a> -->
      </span>
  
    <div class="card-body">
			<p><b>Title: </b>{{ display.title }}</p>
			<p><b>Assignee Name: </b>{{ fetchUser(display.assignee_id) }}</p>
			<p><b>Start Time : </b>{{ display.start | moment("LT dddd, MMMM Do YYYY") }}</p>
			<p><b>End Time : </b>{{ display.end | moment("LT dddd, MMMM Do YYYY") }}</p>
			<p>
				<b>With Users: </b>
				<div class="tags">
				  <span class="tag" v-for="user in JSON.parse(display.users)">{{ fetchUser(user) }}</span>
				</div>
			</p>
			<p><b>Description : </b></p><p v-html="display.description"></p>

	 		<comments-component :commentable_id= "display.id" 
				:logged_user= "logged_user" 
				:model = "model">
			</comments-component>

  	</div>
	</div>
</template>
<!-- All repeat type
1 = Don't Repeat
2 = Every Day
3 = Every Week
4 = Every Month
5 = Every Year -->
<script>
	import flatPickr from 'vue-flatpickr-component';
	import moment from 'moment'
	import Multiselect from 'vue-multiselect'
	import Validation from '../../utils/Validation.js';
	import { VueEditor } from "vue2-editor";
	export default {
		props:['logged_user', 'users', 'focusedSchedule','create_schedule'],
		components: {
	    Multiselect, VueEditor, flatPickr
	  },
		data() {
			return{
				model: 'App\\Models\\SchedulesDisplay', //For Comments Component
				dateConfig: {enableTime: true, dateFormat: "Y-m-d H"},
				validation: new Validation(),
				customToolbar: [
			        ["bold", "italic", "underline"],
			        [{ list: "ordered" }, { list: "bullet" }],
			        ["image", "code-block"]
			    ],
				editType:[ 
						{'id': 1, 'data':'No, Just change this event'},
						{'id': 2, 'data':'Yes, change future occurrences too'}
					],
				masterSchedule:[],
				editSchedule:this.emptyEditSchedule(),
				scheduleEdit:false,
				// up:false,
				display:this.focusedSchedule,
			}
		},
		created(){	
			this.getFocusedSchedule();
			// console.log(this.users)
		},
		methods: {
			takeAction(action) {
				axios.patch(`/pms/schedule/${this.display.id}/take_action`, {action: action}).then(response => {
					
					// console.log(response.data);
					this.$emit('unfocus');
					this.$emit('updateStatus');
					// this.$emit('displays',response.data);
				}).catch(error => console.log(error.response.data));
			},
			deleteMasterSchedule(id){
					Vue.swal({
					  title: 'Are you sure to delete the Master Schedule?',
					  text: "All Schedules and their data will also get deleted and You won't be able to revert this!!",
					  type: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Yes, delete!'
					}).then((result) => {
						if (result.value) {
						 window.axios.get(`/pms/deleteSchedule/${id}`).then(response=>{
							 this.$emit('deleteStatus',response.data);				 	
							Vue.toasted.success('Deleted successfully', {duration:2000});
								// //location.reload();
								// if(response.status == 201){
								// 	Vue.toasted.success('Deleted successfully', {duration:2000});
								// 	// location.reload();
								// }else{
								// 	Vue.swal({
								// 	  type: 'error',
								// 	  title: 'Error !',
								// 	  text: response.data
								// 	})
								// }


								console.log(response.data);

							}).catch(error=>{
								if (error.response.status == 422) {
									this.validation.setMessages(error.response.data.errors);
								}else{
									console.log(error.response.data)
								}
							});
						}
					})
			},
			updateSchedule(){
				let id = this.masterSchedule.id;
				let postData = {};
					postData.title = this.editSchedule.title;
					postData.assignee = this.editSchedule.assignee;
					postData.users =  this.editSchedule.users;
					postData.startDate =  this.editSchedule.startDate;
					postData.endDate =  this.editSchedule.endDate;
					postData.repeat =  this.editSchedule.repeat;
					postData.repeatTillDate = this.editSchedule.repeatTillDate;
					postData.editType = this.editSchedule.editAll.id;
					postData.description = this.editSchedule.description;
					postData.displayId = this.display.id;
					postData.master_id = this.masterSchedule.id;

				window.axios.patch(`/pms/schedule/${id}`,postData).then(response=>{
					console.log(response);
					if(response.status == 201) {
						Vue.swal({
							  type: 'error',
							  title: 'Error!',
							  text: response.data
							})
					} else {
							Vue.swal({
							  type: 'success',
							  title: 'Success!',

							  text: ''								
							})
						this.env.createSchedule = false
  						this.displayLoop = response.data
					}
					
				}).catch(error=>{
					if (error.response.status == 422) {
						this.validation.setMessages(error.response.data.errors);
					}else{
						console.log(error.response.data)
					}
				});
			},
			getFocusedSchedule(){
				window.axios.get(`/pms/schedule/${this.focusedSchedule.id}`).then(response=>{
						console.log(response.data);
						this.masterSchedule= response.data;
				}).catch(error => console.log(error.response.data));
			},
			emptyEditSchedule(){
				return{
					title: null,
					assignee: null,
					startDate: null,
					endDate: null,
					users:[],
					editAll: {data:"No, Just change this event",id:1},
					repeatTillDate: null,
					repeatTillDateNoEdit: null,
					description: null,

				}
			},
			// toggleEditSchedule(){
			// 	if(this.scheduleEdit){
			// 			this.editSchedule = this.emptyEditSchedule();
			// 	}else{
			// 		this.editSchedule.title = this.display.title;
			// 		this.editSchedule.startDate = this.display.start;
			// 		this.editSchedule.endDate = this.display.end;
			// 		this.editSchedule.repeat = this.masterSchedule.repeat; 
			// 		this.editSchedule.repeatTillDateNoEdit = this.masterSchedule.expiry_date;
			// 		this.editSchedule.repeatTillDate = this.masterSchedule.expiry_date;
			// 		this.editSchedule.description = this.display.description;
			// 		this.editSchedule.assignee = this.fetchUserObject(this.display.assignee_id);
			// 		let users=[];
			// 		let usersArray = JSON.parse(this.display.users);
			// 		this.editSchedule.users = users;
			// 	}
			// 	this.scheduleEdit = !this.scheduleEdit;
			// },
			humanReadableTime(date) {
				return moment(date,'YYYY-MM-DD HH:mm:ss').fromNow();
			},
			fetchUserObject(id) {
				let x = '';
				this.users.forEach(function(v,k) {
					if(id == v.id) {
						x = v;
					}
				});
				return x;
			},
			fetchUser(id) {
				let x = '';
				this.users.forEach(function(v,k) {
					if(id == v.id){
						x = v.name;
					}
				});
				return x;
			},
		
		},

	}
</script>