<template>
  <v-app id="inspire">
    <v-content>
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <v-card class="elevation-12">
              <v-toolbar
                color="primary"
                dark
                flat
              >
                <v-toolbar-title>Login form</v-toolbar-title>
                <v-spacer />
                 
                 
              </v-toolbar>
              
  <v-form @submit.prevent="login">
    <v-card-text>
    <v-text-field
      v-model="form.email"
      :error-messages="emailErrors"
      label="E-mail"
      required
      @input="$v.email.$touch()"
      @blur="$v.email.$touch()"
    >
    </v-text-field>
    <v-text-field
      v-model="form.password"
      :error-messages="passwordErrors"
      label="password"
      type="password"
      required
      @input="$v.password.$touch()"
      @blur="$v.password.$touch()"
    ></v-text-field>
     
</v-card-text>
              <v-card-actions>
                <v-spacer />
                <v-btn type="submit" color="primary">Login</v-btn>
              </v-card-actions>
    
   
  </v-form>
  
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </v-app>
</template>
<script>
  import { validationMixin } from 'vuelidate'
  import { required, maxLength, minLength, email } from 'vuelidate/lib/validators'
  export default {
    mixins: [validationMixin],
    validations: {
      password: { required, minLength: minLength(4) },
      email: { required, email },
       
    },
    data() {
        return {
            form:{
                email: '',
                password:''
            }
        }
      
       
    },
    computed: {
       
       
      passwordErrors () {
        const errors = []
        if (!this.$v.password.$dirty) return errors
        !this.$v.password.maxLength && errors.push('password min be at most 4 characters long')
        !this.$v.password.required && errors.push('password is required.')
        return errors
      },
      emailErrors () {
        const errors = []
        if (!this.$v.email.$dirty) return errors
        !this.$v.email.email && errors.push('Must be valid e-mail')
        !this.$v.email.required && errors.push('E-mail is required')
        return errors
      },
    },
    created(){
      if(User.loggedIn()){
        this.$router.push('tasks')
      }
    },
    methods: {
      submit () {
        this.$v.$touch()
      },
      login(){
          
          User.login(this.form);
          this.$router.push({name:'tasks'})
      },
      clear () {
        this.$v.$reset()
        this.name = ''
        this.email = ''
        this.select = null
        this.checkbox = false
      },
    },
  }
</script>