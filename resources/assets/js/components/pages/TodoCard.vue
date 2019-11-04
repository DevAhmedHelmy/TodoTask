<template>

   
     <div >
       <v-card>
     
    <v-list>
      <draggable v-model="cards" :options="{group:'cards'}" @add="onAdd" :listId="list.id" style="min-height: 25px" >

      <v-list-item v-for="card in cards" v-bind:key="card.id">
         

        <v-list-item-content>
          <v-list-item-title v-text="card.name"></v-list-item-title>
        </v-list-item-content>

        
      </v-list-item>
      </draggable>
      <v-list-tile>
        <a href="#">Add card</a>
      </v-list-tile>
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
      cardData:{name:''},
      editCardId : '',
    }
  },
  created () {
    this.cards=this.list.cards;
    console.log(this.cards);
  },

  methods:{
     
    createCard(listId) {
      this.editCardId=listId;
      axios.post("/api/todos/"+this.list.todo_id+"/items/"+this.list.id+"/card",{name:this.cardData.name})
          .then(response => {
            let vm = this;
            vm.cards.push(response.data.card);
            console.log(cards)
            console.log(response.data.card)
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