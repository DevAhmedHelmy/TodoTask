<template>

   
     <div >
       <v-card>
     
    <v-list>
      <draggable v-model="cards" :options="{group:'cards'}" @add="onAdd" :listId="list.id" style="min-height: 25px" >

      <v-list-item v-for="card in cards" v-bind:key="card.id">
         

        <v-list-item-content>
          <v-list-item-title v-text="card.name">
               

            </v-list-item-title> 
           
        </v-list-item-content>
        <v-icon @click.stop="deleteCard(card.id)">mdi-delete</v-icon>
        <v-icon>mdi-pencil</v-icon>
        
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
		 
	</div>
  
      
</template>


<script>
import draggable from 'vuedraggable';
import Sortable from 'sortablejs';

export default {
  props:['list'],
  components:{draggable},
  data() {
    return {
      cards : {},
      cardData:{name:'',description:''},
      editCardId : '',
    }
  },
  created () {
    this.cards=this.list.cards;
     
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
      axios.put("/api/card/"+cardId,{lists_id:listId})
      .then(
        // response => {console.log(listId);console.log(cardId);console.log(response);}
      );
    },

    deleteCard(cardId){
      axios.delete("/api/card/"+cardId)
      .then(
        // response => {console.log(response); }
      );
    },
     
    onAdd(evt){

    // let fromListId = evt.from.getAttribute('listId');
    let cardId = evt.item.getAttribute('cardId');
    let toListId = evt.to.getAttribute('listId');

    this.updateCard(cardId,toListId);
  }
 
  },

}
</script>