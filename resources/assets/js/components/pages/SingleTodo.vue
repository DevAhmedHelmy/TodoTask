<template>
   
  <div @click="editMode=false; updateListId=null">
     
     
  
        
      <h2> {{todo.name}} </h2>
      
 
          <v-layout row wrap>
            <v-flex md3 v-for="list in lists" :key="list.id">
              <v-card class="gray lighten-2">
                <v-toolbar class="green white--text" dark dense>
                  <v-text-field @click.stop v-model="listName" label="List Name" v-if="updateListId==list.id" @keyup.enter="updateList"></v-text-field>
                  <v-toolbar-title  @click.stop="updateListId=list.id" v-else>{{list.name}}</v-toolbar-title>
                   <v-spacer></v-spacer>

                  <v-menu bottom left>
                  <template v-slot:activator="{ on }">
                    <v-btn
                      dark
                      icon
                      v-on="on"
                    >
                      <v-icon>mdi-dots-vertical</v-icon>
                    </v-btn>
                  </template>

                  <v-list>
                    <v-list-item @click.stop="deleteList(list.id)">
                      <v-list-item-title>Delete</v-list-item-title>
                    </v-list-item>
                  </v-list>
                </v-menu>
                </v-toolbar>

              <todo-card :list="list"></todo-card>
                
              </v-card>
            </v-flex>
          
            <v-flex md3>
                <v-card>
                  <v-card-title class="gray">
                    <v-text-field  @click.stop v-model="listName" label="List Name" v-if="editMode" @keyup.enter="storeList"></v-text-field>
                     
                    <v-btn small @click.stop="editMode=true" v-else>Add a list...</v-btn>
                  </v-card-title>
                </v-card>
            </v-flex>

          </v-layout>
        
    
</div>

      
</template>


<script>

import TodoCard from '../pages/TodoCard.vue';
 

export default {
  
  data() {
    return {
      todos:'',
      todo:'',
      lists:{},
      cards:'',
      todoId:'',
      listName:'',
      editMode:false,
      updateListId:"",
      deleteListId:"",
    }
  },

  components:{
    TodoCard,
  },

  created () {
    this.todoId = this.$route.params.id;
    this.fetchTodosData();
  },

  methods : {
     
    getLists(){
      this.todos.map((todo)=> {
        if (todo.id == this.todoId) {
          this.todo=todo;
          return this.lists = todo.lists;
        }
      })
    },

    storeList(){
      this.editMode=false;
      axios.post("/api/todos/"+this.todoId+"/items",{name:this.listName})
          .then(response => {
            this.fetchTodosData();
      });
    },

    updateList(){
      axios.put("/api/todos/"+this.todosId+"/items/"+this.updateListId,{name:this.listName})
          .then(response => {
            this.updateListId=null;
            this.listName='';
            this.fetchTodosData();
      });
    },

    deleteList(listId) {
      axios.delete("/api/todos/"+this.todoId+"/items/"+listId)
          .then(response => {
            this.fetchTodosData();
      });
    },

    fetchTodosData() {
           
           axios.get("/api/todos")
          .then(response => {
            this.todos = response.data.data;
            this.getLists();
          });
        }
  }


}
</script>