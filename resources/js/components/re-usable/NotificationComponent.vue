<template>
<div>
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>

        <span class="label label-danger" v-if="pings.length !=0">{{ pings.length}}</span>
      </a>  
      <ul class="dropdown-menu" v-if="pings.length !=0">
        <li class="header">You have {{ pings.length}} notifications </li>
        <li>
          <!-- inner menu: contains the actual data -->
          <ul class="menu">
           
            <li v-for="notification in pings">
               <a :href="`/notification_read/${notification.id}`" >
                  <i class="fa fa-tasks "></i> 

                  <span> {{notification.data.title}}</span>
                  <br>
                  <span>{{notification.data.message}}</span>
                 
                  <br><span></span>
              </a>
            </li>

            <li>
          </li>
        </ul>
      </li>
      <li class="footer">
        <a href="">All Notifications</a>
      </li>
    </ul>
  </div>
</template>
<style scoped>
	.dropdown-item.active, .dropdown-item:active{
		background: transparent!important;
	}
</style>
<script>
  import { EventBus } from './../../event-bus.js';
	export default {
		props: ['notifications', 'logged_user'],
		components: {},
		data () {
			return {
				pings : [],
			}
		},
		created() {
			Echo.private('App.User.' + this.logged_user.id).notification((notification) => {
        this.playSound('/sounds/open-ended.mp3');
        this.pings.unshift(notification);
	    });
		},
		mounted() {
			this.pings = this.notifications;
      EventBus.$on('notification-dismissed', notify_id => {
        console.log('event bus working!');
        this.pings = this.pings.filter(p => (p.id !== notify_id));
      });
		},
		methods: {
    	playSound (sound) {
	      if(sound) {
	        var audio = new Audio(sound);
				  audio.play();
	      }
	    },
		}
	}
</script>
<style>
	.avatar-icon{
		font-size: 125%;
    vertical-align: sub;
    position: absolute;
    left: 0;
    right: 0;
    margin: auto;
    top: 10px;
	}
</style>
