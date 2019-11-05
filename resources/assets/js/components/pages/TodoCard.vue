<template>

   
    
       <v-card style="margin: 0 10px 0 10px;">
     
    <v-list>
      <draggable v-model="cards" v-bind="{animation:200,group:'cards'}" @add="onAdd" style="min-height: 25px" v-on:listId="list.id">

      <v-list-item v-for="card in cards" :key="card.id" :cardId="card.id">
         

        <v-list-item-content>
          <v-list-item-title v-text="card.name">
                

            </v-list-item-title> 
           
        </v-list-item-content>
        
        <v-icon size="15px" @click.stop="fetchComments(card.id)">fas fa-comments</v-icon>
        <v-icon size="15px" @click.stop="showCard(card.id)">fas fa-eye</v-icon>
        <v-icon size="15px" @click.stop="deleteCard(card.id)">fas fa-trash-alt</v-icon> 
        
      </v-list-item>
        
      </draggable>
      <v-list-item v-for="comment in comments" :key="comment.id">
        <v-list-item-title v-text="comment.comment">
                      

          </v-list-item-title>
         
      </v-list-item>
      <v-list-tilte>
        <v-text-field @click.stop v-model="commentData.comment" label="Comment" v-if="showComment" @keyup.enter="storeComment()" ></v-text-field>
        
        <v-btn depressed small color="primary" v-if="list.id==editCardId" @click="createCard(list.id)">Add Card</v-btn>
         
        
      </v-list-tilte>

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