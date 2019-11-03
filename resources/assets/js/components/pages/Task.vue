<template>
 <v-layout row wrap>
            <v-flex grow pa-1 v-for="task in tasks" :key="task.id">

              <router-link style="cursor: pointer" :to="{name:'SingleBoard',params:{id:task.id}}" tag="span">

                <v-card dark color="green darken-1">
                  <v-card-text>{{task.name}}</v-card-text>
                </v-card>

              </router-link>
            </v-flex>
            <v-flex md3>
                <!-- <v-card>
                  <v-card-title class="gray">
                    <v-text-field  @click.stop v-model="BoardName" label="Board Name" v-if="editMode" @keyup.enter="storeBoard"></v-text-field>
                    <v-btn flat small @click.stop="editMode=true" v-else>Add a Board...</v-btn>
                  </v-card-title>
                </v-card> -->
            </v-flex>
          </v-layout>
</template>

<script>
import draggable from "vuedraggable";
let id = 1;
export default {
  data(){
        return{
          drawer: true,
           
          BoardName:'',
          editMode:false,
          tasks:{}
        }
    },
    created(){
            // Make a request for a user with a given ID
            axios.get('api/todos')
            .then( res => this.tasks = res.data.data )
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            
        }
}
</script>
<style scoped>
.buttons {
  margin-top: 35px;
}
.ghost {
  opacity: 0.5;
  background: #c8ebfb;
}
</style>