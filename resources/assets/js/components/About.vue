<template>
           
            <div class="panel-body">
    
                    <div v-if="edit">
                            <h1>About Me</h1>
                            <form @submit.prevent="update">
                                <div class="form-group">
                                    <label for="education">Education</label>
                                    <input v-model="curr_user.education" type="text" name="education" class="form-control"> 
                                </div>
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input v-model="curr_user.location" type="text" name="location" class="form-control"> 
                                    </div>
                                <div class="form-group">
                                        <label for="bio">Bio</label>
                                    <textarea v-model="curr_user.bio"  class="form-control" required name="bio"></textarea>
                                </div>
                                <button class="btn btn-xs btn-primary" @click="update">Update</button>
                                <button class="btn btn-xs btn-link" @click="edit = false" type="button">Cancel</button>
                            </form>
                        </div>
    
                    <div v-else>
                        <div class="box box-primary">
                                <div class="box-header with-border">
                                  <h3 class="box-title">About Me</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                        <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
                                
                                        <p class="text-muted">
                                                {{ curr_user.education }}
                                        </p>
                                
                                        <hr>
                                
                                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                                
                                        <p class="text-muted">{{ curr_user.location}}</p>
                                
                                        <hr>
                                                        
                                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Bio</strong>
                                
                                        <p>{{ curr_user.bio}}</p>
                                </div>
                            </div>
                           
                                <button v-if="canUpdate"   class="btn btn-xs btn-primary" @click="edit = true">Edit</button>
                            
                            
                            
                        </div>
        </div>
  
       
</template>

<script>
    export default{
        props: ['user'],

        data(){
            return {
                edit: false,
                curr_user: {
                    id: '',
                    education: '',
                    location: '',
                    bio: ''
                }
            };
        },

         mounted(){
            
            this.fetchUser();
        },
        computed: {
            canUpdate(){
                return this.authorize(user => user.id === this.user.id);
            }
        },


         methods: {
            fetchUser(){
                console.log('fetching  contacts');
                let self = this;
                axios.get('api/about/'+self.user.name)
                    .then((response)=>{
                        console.log(response.data[0]);
                        self.curr_user = response.data[0];
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
            },

            update(id){
                console.log('update '+ id +'channel');
                let self = this;
                let params = Object.assign({}, self.curr_user);
                axios.patch('api/about/'+self.user.name, params)
                    .then(()=>{
                        self.edit = false;
                        // flash('Updated a channel');
                        self.fetchUser();
                        
                    })
                    .catch((error)=>{
                        console.log(error);
                        // flash(error.response.data, 'danger');
                    });
            },
        }
    }
</script>