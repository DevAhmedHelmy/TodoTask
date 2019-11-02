<template>
    
</template>
<script>
export default {
    created(){
        EventBus.$emit('logout')
        $this.router({name:'login'})
    }
}
</script>