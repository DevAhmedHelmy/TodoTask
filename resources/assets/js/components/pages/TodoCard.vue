<template>

  <div>

    <v-list class="grey lighten-3">

      <draggable v-model="cards" :options="{group:'cards'}" @add="onAdd" :listId="list.id" style="min-height: 25px" >

        <li v-for="card in cards" :key="card.id" :cardId="card.id">
            <v-list-title avatar>
              <v-list-title-content>
                <v-list-title  
                  style="border-radius:5px;height: 35px;line-height: 40px;"
                  class="white">
                  <div class="pl-3 py-0">{{card.name}}</div>
                  </v-list-title>
                <v-list-title-sub-title></v-list-title-sub-title>
              </v-list-title-content>
            </v-list-title>
        </li>

      </draggable>
      

      <v-list-title @keyup.esc="editCardId=null">

        <v-text-field @click.stop v-model="cardData.name" label="Card Name" v-if="list.id==editCardId" @keyup.enter="createCard(list.id)"></v-text-field>

        <a @click="editCardId=list.id" v-else>Add Card</a>

      </v-list-title>
    </v-list>
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
      cards : '',
      cardData:{name:''},
      editCardId : '',
    }
  },
  created () {
    this.cards=this.list.cards;
  },

  methods:{
    
    createCard(listId) {
      this.editCardId=listId;
      axios.post("/api/todos/"+this.list.board_id+"/items/"+this.list.id+"/card",{name:this.cardData.name})
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
      axios.put("/api/card/"+cardId+"?api_token="+token,{lists_id:listId})
      .then(
        // response => {console.log(listId);console.log(cardId);console.log(response);}
      );
    },

    deleteCard(cardId){
      axios.delete("card/"+cardId+"/?api_token="+token)
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