<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
      v-if="loggedIn"
    >
      <v-list dense>
        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="link" to="/todos" style="cursor:pointer" tag="span"> 
                   
                    <span>Todos</span>
                     
                   
              </router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-contact-mail</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="link" to="/about" style="cursor:pointer" tag="span"> 
                   
                    <span>About</span>
                     
                   
              </router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-contact-mail</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="link" to="/contact" style="cursor:pointer" tag="span"> 
                   
                    <span>Contact Us</span>
                     
                   
              </router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      app
      color="indigo"
      dark
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" v-if="loggedIn" />
      <v-toolbar-title>Tasks</v-toolbar-title>
       <v-spacer></v-spacer>
      <v-toolbar-items>

        <router-link
        class="navLink"
          v-for="item in items"
          :key="item.title"
          :to="item.to"
          v-if="item.show">
          <v-btn text>{{item.title}}</v-btn>
        </router-link>
      </v-toolbar-items>

    </v-app-bar>

    <v-content>
      <v-container>
        <v-row
          align="center"
          justify="center"
        >
          <v-col class="text-center">
             

             <router-view></router-view>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
    <v-footer
      color="indigo"
      app
    >
      <span class="white--text">&copy; 2019</span>
    </v-footer>
  </v-app>
</template>
<script>
  export default {
    props: {
      source: String,
    },
    data(){
      return{
      drawer: null,
      loggedIn:User.loggedIn(),
      items:[
           
          {title:'Login', to:'/login',show: !User.loggedIn()},
           
          {title:'Logout', to:'/logout',show:User.loggedIn()},
        ]
      }
      
    },
    created(){
    

      EventBus.$on('logout',()=>{
        User.logout();
        this.$router.push({name:'login'})
      });

      
    },

    

    
  }
</script>

<style scoped>
  .link {
    margin: 5px;
    border-radius: 4px;
    background-color: inherit;
    text-align: left;
  }
  .navLink {
    margin: 10px;
    border-radius: 4px;
    background-color: inherit;
    text-align: left;

  }
   
</style>