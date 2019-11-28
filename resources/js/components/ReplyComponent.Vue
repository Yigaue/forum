<template>
<div>
<div :id = "'reply-'+id" class="card">

        <div class="card-header">

         <div class="level">
             <h5  class="flex">
             <!-- <a :href="'/profiles/'+data.owner.name"
             >{{data.owner.name}}</a> said -->
             <!-- OR THIS BELOW -->
             <a :href="'/profiles/'+data.owner.name"
             v-text="data.owner.name"></a> said
            <span v-text="ago"></span>
            </h5>
             <!--
             @if(Auth::check())
         <div>
         <favorite-component :reply="{{$reply}}"></favorite-component>
        </div>
        @endif -->

       <!--  -->
     <div v-if="signedIn">      <!-- ////////Resurrect this guy after fixing the global bug issue///////-->

            <favorite-component :reply="data"></favorite-component>
        </div>

         </div>
        </div>
            <div class="card-body">
                <div v-if="editing">

                    <div class="form-group">
                    <textarea class="form-control" v-model = "body"></textarea>
                    </div>
                    <button class="btn btn-sm btn-primary" @click="update">Update</button>
                     <button class="btn btn-sm btn-link" @click="editing = false">Cancel</button>
                </div>
                <div v-else v-text="body">

                </div>

                </div>

        <div class="card-footer level" v-if="canUpdate">      <!--//////////////Resurrect this guy after fixing the global bug issue//////////////// -->

             <button class="btn btn-secondary btn-sm mr-3" @click="editing = true">Edit</button>
             <button class="btn btn-danger btn-sm mr-3" @click="destroy">Delete</button>
            </div>
        </div>
        <br/>
        </div>

</template>
<script>
import FavoriteComponent from './FavoriteComponent.vue';
import moment from 'moment';
export default {
    props: ['data'],
    components: {FavoriteComponent},
    data(){
        return{
            editing: false,
            id: this.data.id,
            body: this.data.body
        };
    },
     computed: {
         signedIn(){
              return window.App.signedIn;
         },
         ago(){
             return moment(this.data.created_at).fromNow();
         },
         canUpdate(){
    return this.authorize(user => this.data.user_id == user.id);
        // return this.data.user_id == window.App.user.id;
        }
     },
    methods: {
        update(){
            axios.patch('/replies/' + this.data.id,{
                body: this.body
            });

            this.editing = false;
            flash('Updated!');
        },
        destroy(){
            axios.delete('/replies/' + this.data.id);
            this.$emit('deleted', this.data.id);
            // $(this.$el).fadeOut(300, ()=> {
            // flash('your reply has been deleted.');

            // });
        }
    }

}
</script>
