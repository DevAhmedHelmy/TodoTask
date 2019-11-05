<template>
 <v-row class="mb-6">
    <v-col grow pa-1 v-for="todo in todos" :key="todo.id">
        <v-card dark color="green darken-1">
          
            <v-app-bar
              dark
              color="green">
              
            <router-link style="cursor:pointer" :to="{name:'SingleTodo',params:{id:todo.id}}" tag="span">
              <v-toolbar-title>{{todo.name}}</v-toolbar-title>
              </router-link>
              <v-spacer></v-spacer>

              <v-btn icon>
                <v-icon @click.stop="deleteTodo(todo.id)">fas fa-trash-alt</v-icon>
              </v-btn>
            </v-app-bar>
        </v-card>

    </v-col>
    <v-col>
        <v-card>
          <v-card-title class="gray">
            <v-text-field  @click.stop v-model="TodoName" label="Todo Name" v-if="editMode" @keyup.enter="storeTodo">

            </v-text-field>
            <v-btn small @click.stop="editMode=true" v-else>Add a Todo...</v-btn>
          </v-card-title>
        </v-card>
    </v-col>
  </v-row>
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
          todos:{},
          errors:[]
        }
    },
    created(){
            // Make a request for a user with a given ID
            this.getTodos();
            
        },
        methods:{
          storeTodo(){
            this.editMode=false;
            axios.post("/api/todos",{name:this.TodoName})
                .then(response => {
                  // console.log(response);
                  let newList = response.data.todo;
                  this.todos.push(newList);
                  this.TodoName='';
            }).catch(function (error) {
                this.errors = error.response.data.errors
                console.log(error.response.data.errors)
            });
          },
          deleteTodo(todoId){
            axios.delete('/api/todos/'+todoId)
            .then(
              // response=>{console.log(response.data)}
              this.getTodos()
            )
          },

          getTodos(){
          axios.get('api/todos')
            .then( res => this.todos = res.data.data )
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        }
        },

        
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