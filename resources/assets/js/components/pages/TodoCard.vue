<template>

   
    
       <v-card style="margin: 0 10px 0 10px;">
     
    <v-list>
      <draggable v-model="cards" v-bind="{animation:200,group:'cards'}" @add="onAdd" style="min-height: 25px" v-on:listId="list.name">

      <v-list-item v-for="card in cards" :key="card.id" :cardId="card.id">
         

        <v-list-item-content>
          <v-list-item-title v-text="card.name">
               

            </v-list-item-title> 
           
        </v-list-item-content>
        
        <v-icon @click.stop="showCard(card.id)">mdi-television</v-icon>
        <v-icon>mdi-pencil</v-icon>
        <v-icon @click.stop="deleteCard(card.id)">mdi-delete</v-icon>
        
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
     
      cards : {},
      cardData:{name:'',description:''},
      editCardId : '',
      cardShow:false,
      cardShowData:'',
      
    }
  },
  created () {
    this.cards=this.list.cards;
    console.log(this.list)
     
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
     
    onAdd(evt){
      // console.log(evt)
    let fromListId = evt.from.getAttribute('listId');
    let cardId = evt.item.getAttribute('cardId');
    let toListId = evt.to.getAttribute('listId');
    console.log(toListId);
    console.log(evt.to)
    this.updateCard(cardId,toListId);
  }
 
  },

}
</script>

<style scoped>

</style>