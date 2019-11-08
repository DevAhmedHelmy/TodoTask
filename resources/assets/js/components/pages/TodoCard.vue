<template>

  <v-card>
     
    <v-list class="grey lighten-3">
       <draggable v-model="cards" :options="{group:'cards'}"  @add="onAdd($event, list)" style="min-height: 25px" >

        <v-list-item class="tile" v-for="card in cards" :key="card.id" :cardId="card.id" >
         

          <v-list-item-content >
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
                color="purple darken-4"
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
              <v-divider></v-divider>
              <v-card-text>Card description : {{card.description}}</v-card-text>
              <v-divider></v-divider>
              <v-card-text>Comments : </v-card-text>
              <v-card-text v-for="comment in comments" :key="comment.id">
                {{comment.comment}}
                {{comment.created_at}}
              </v-card-text>
                  
              <v-divider></v-divider>


              <v-card-text>
                  <span>Add Comment</span>
                  <v-text-field @click.stop v-model="commentData.comment" label="Comment" v-if="showComment" @keyup.enter="storeComment()" ></v-text-field>
                  
              </v-card-text>
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
            <v-icon color="red accent-4" dark size="15px" @click.stop="deleteCard(card.id)">fas fa-trash-alt</v-icon> 
        </v-list-item>
        
      </draggable>
      

      <v-list-tilte>
        <v-text-field class="card" @click.stop v-model="cardData.name" label="Card Name" v-if="list.id==editCardId"></v-text-field>
        <v-text-field class="card" @click.stop v-model="cardData.description" label="Card description" v-if="list.id==editCardId"></v-text-field>
        <v-btn depressed small color="primary" v-if="list.id==editCardId" @click="createCard(list.id)">Add Card</v-btn>
        <v-btn class="mx-2" @click="editCardId=list.id" v-else small dark color="purple darken-4">
          <v-icon white>mdi-plus</v-icon>
        </v-btn>
        
      </v-list-tilte>
       
      


    </v-list>
  </v-card>
		 
	  
      
</template>


<script>
import Sortable from 'sortablejs';
import draggable from 'vuedraggable';

 
 
export default {
  props:['list'],
  components:{draggable},
  
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
   
   onAdd(evt,list){

    // let fromListId = evt.from.getAttribute('listId');
    let cardId = evt.item.getAttribute('cardId');
  
    
    let toListId= list.id;
    this.updateCard(cardId,toListId);
  }
 
  },

}
</script>

<style scoped>
  .tile {
    margin: 5px;
    border-radius: 4px;
    background: rgb(206, 198, 198);
    color: white;
    text-align: left;
  }
  .card{
  padding-left: 5px
}
</style>
   
</style>