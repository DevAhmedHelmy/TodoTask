<template>

   
    
       <v-card style="margin: 0 10px 0 10px;">
     
    <v-list>
      <draggable v-model="cards" v-bind="{animation:200,group:'cards'}" @add="onAdd" style="min-height: 25px" v-on:listId="list.id">

      <v-list-item v-for="card in cards" :key="card.id" :cardId="card.id">
         

        <v-list-item-content>
          <v-list-item-title v-text="card.name">
                

            </v-list-item-title> 
           
        </v-list-item-content>
         
        
         
        
        <!-- to show comment -->
        <div class="text-center">
            <v-dialog
              v-model="dialog"
              width="500"
            >
              
        <template v-slot:activator="{ on }">
                <v-btn 
                  icon
                  color="red lighten-2"
                  dark
                  v-on="on"
                  @click.stop="fetchComments(card.id)"
                >
                  <v-icon>fas fa-eye</v-icon>
                </v-btn>
              </template> 
              <v-card>
                <v-card-title
                  class="headline grey lighten-2"
                  primary-title
                >
                  Show Card
                </v-card-title>

                <v-card-text>
                  Card Name : {{card.name}}

                  
                </v-card-text>
                <v-card-text>Card description : {{card.description}}</v-card-text>

                <v-card-text>Comments : </v-card-text>
                <v-card-text v-for="comment in comments" :key="comment.id">
                  {{comment.comment}}
                  {{comment.created_at}}
                </v-card-text>
                
                <v-divider></v-divider>


                <v-list-tilte>
                    <v-text-field @click.stop v-model="commentData.comment" label="Comment" v-if="showComment" @keyup.enter="storeComment()" ></v-text-field>
                    
                </v-list-tilte>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn
                    color="primary"
                    text
                    @click="dialog = false"
                  >
                    Close
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </div>
          <v-icon color="red lighten-2" dark size="15px" @click.stop="deleteCard(card.id)">fas fa-trash-alt</v-icon> 
      </v-list-item>
        
      </draggable>
      

      <v-list-tilte>
        <v-text-field @click.stop v-model="cardData.name" label="Card Name" v-if="list.id==editCardId"></v-text-field>
        <v-text-field @click.stop v-model="cardData.description" label="Card description" v-if="list.id==editCardId"></v-text-field>
        <v-btn depressed small color="primary" v-if="list.id==editCardId" @click="createCard(list.id)">Add Card</v-btn>
        <v-btn class="mx-2" @click="editCardId=list.id" v-else small dark color="indigo">
          <v-icon dark >mdi-plus</v-icon>
        </v-btn>
        
      </v-list-tilte>
       
      


    </v-list>
  </v-card>
		 
	  
      
</template>


<script>
import draggable from 'vuedraggable';
import Sortable from 'sortablejs';
 
 
export default {
  
  components:{draggable},
  props:['list'],
  data() {
    return {
     dialog: false,
      cards : {},
      cardData:{name:'',description:''},
      commentData:{comment:''},
      editCardId : '',
      cardShow:false,
      cardShowData:'',
      comments:{},
      showComment:false
       
      
    }
  },
  created () {
    this.cards=this.list.cards;
    this.getComments();
    
     
     
  },

  methods:{
     
    createCard(listId) {
      this.editCardId=listId;
      
      axios.post("/api/todos/"+this.list.todo_id+"/items/"+this.list.id+"/card",{name:this.cardData.name, description:this.cardData.description})
          .then(response => {
            let vm = this;
            vm.cards.push(response.data.card);
             
            vm.cardData='';
            vm.editCardId='';

      });
    },
    updateCard(cardId,listId){
      axios.put("/api/card/"+cardId,{item_id:listId})
      .then(
        // response => {console.log(listId);console.log(cardId);console.log(response);}
      );
    },

    deleteCard(cardId){
      axios.delete("/api/card/"+cardId)
      .then(
        response => {console.log(response); }
      );
    },
    showCard(cardId){
      this.cardShow = true
      axios.get('/api/card/'+cardId)
      .then(response=>{
          this.cardShowData = response.data.data
           
      })
    },
    // to store comment
      storeComment(cardId){
        console.log(cardId);
      },

    // to get all comments
    getComments(){
      axios.get('/api/comments')
      .then(response=>{
        // console.log(response.data.data)
      })
    },
     fetchComments(cardId) {
       this.showComment = true;
        axios.get(`/api/comments/` + cardId)
        
            .then(response => {
            this.comments = response.data.comments
             

            // or for paginated results
            // this.comments = response.data.data
        }).catch()
    },
    onAdd(evt){
      console.log(evt)
    let fromListId = evt.from.getAttribute('listId');
    let cardId = evt.item.getAttribute('cardId');
    let toListId = evt.to.getAttribute('listId');
    console.log(toListId);
    // console.log(evt.to)
    this.updateCard(cardId,toListId);
  }
 
  },

}
</script>

<style scoped>

</style>