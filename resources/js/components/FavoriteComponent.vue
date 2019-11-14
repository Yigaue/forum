<template>

 <button type="submit" :class="classes" @click="toggle"> <!--{{$reply->active()? 'disabled': ''}} -->
        <span class="glyphicon glyphicon-heart">&#10084;</span>
            <span v-text= "count"></span> <!--{{$reply->favorites_count}}   {{str_plural('Favorite', $reply->favorites_count)}}  /*We don't need this */ -->
     </button>

</template>

<script>
export default {
    props:['reply'],

    data(){

        return {

            count: this.reply.favoritesCount,
            active: this.reply.isFavorited,
        }
    },
    computed: {
        classes(){
            return [
                'btn',
                 this.active ? 'btn-secondary' : 'btn-default'
                 ];
        },
        endpoint(){
                return '/replies/'+this.reply.id+'/favorites';
         }
    },

    methods: {
        toggle(){
          return this.active ? this.destroy() : this.create();
            if(this.active){
                // unfavorite it
                this.destroy()

            }
            else{
                this.create()
            }
        },

        create(){
             axios.post(this.endpoint);
            this.active = true;
            this.count++;

        },

        destroy(){
              axios.delete(this.endpoint);
             this.active = false;
            this.count-- ;

        }
    },


}
</script>
