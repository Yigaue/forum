<template>
    <div>
        <div v-for="(reply, index ) in replies" :key="reply.id">
            <reply-component :data="reply" @deleted="remove(index)" ></reply-component>
        </div>
<paginator :dataSet="dataSet" @changed ="fetch"></paginator>

        <new-reply @created="add"></new-reply>
        <!-- <new-reply :endpoint="endpoint" @created="add"></new-reply> -->

    </div>
</template>
<script>

import ReplyComponent from './ReplyComponent.vue';
import NewReply from './NewReply.vue';
import collection from '../mixins/collection';

export default {
    // props: ['data'], /////removing during pagination because that data was no longer passed
       components: {ReplyComponent, NewReply},
mixins: [collection],
    data(){

        return{
            dataSet: false,
            ///remove because nloger useful since pagination data is handling that /// endpoint: location.pathname+'/replies',
        }

   },

   created(){
       this.fetch();
   },
   methods:{

       fetch(page){
           axios.get(this.url(page)).then(this.refresh);
       },
       url(page){
           if(! page){
             let query =  location.search.match(/page=(\d+)/);
             page = query ? query[1] : 1;
           }
        //    return `${location.pathname}/replies?page=`+page;
           return `${location.pathname}/replies?page=${page}`;

       },
       refresh({data}){
          this.dataSet = data;
          this.replies = data.data;
          window.scrollTo(0,0);

       },
       ///////////////Transfered to mixins/Collection.js
    //    add(reply){
    //        this.replies.push(reply);
    //        this.$emit('added');
    //    },
    //    remove(index){
    //        this.replies.splice(index, 1);
    //        this.$emit('removed');
    //        flash('Reply was deleted');

    //    }
   }
}
</script>
