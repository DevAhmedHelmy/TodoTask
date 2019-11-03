<template>
 <v-layout row wrap>
            <v-flex grow pa-1 v-for="todo in todos" :key="todo.id">

              <router-link style="cursor:pointer" :to="{name:'SingleTodo',params:{id:todo.id}}" tag="span">

                <v-card dark color="green darken-1">
                  <v-card-text>{{todo.name}}</v-card-text>
                </v-card>

              </router-link>
            </v-flex>
            <v-flex md3>
                <v-card>
                  <v-card-title class="gray">
                    <v-text-field  @click.stop v-model="TodoName" label="Todo Name" v-if="editMode" @keyup.enter="storeTodo"></v-text-field>
                    <v-btn small @click.stop="editMode=true" v-else>Add a Todo...</v-btn>
                  </v-card-title>
                </v-card>
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
           
          TodoName:'',
          editMode:false,
          todos:{}
        }
    },
    created(){
            // Make a request for a user with a given ID
            axios.get('api/todos')
            .then( res => this.todos = res.data.data )
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            
        },
        methods:{
          storeTodo(){
            this.editMode=false;
            axios.post("/api/todos",{name:this.TodoName})
                .then(response => {
                  console.log(response);
                  let newList = response.data.todo;
                  this.todos.push(newList);
                  this.TodoName='';
            });
          },
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