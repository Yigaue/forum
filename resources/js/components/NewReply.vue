<template>
<div>
    <div v-if="signedIn">
     <!-- @if(auth()->check()) -->

            <!-- <form method="post" action="{{$thread->path().'/replies'}}"> -->
                    <div class="form-group">
                    <textarea name="body"
                    id ="body" class="form-control"
                    placeholder="join the discussion"
                     rows="5"
                     required
                     v-model="body"></textarea>
                    </div>
                <button type="submit"
                 class="btn btn-secondary"
                 @click="addReply">leave comment</button>
                 </div>
             <!-- </form> -->
             <!-- @else -->
                 <p class="text-center" v-else>
                Please <a href="'/login">Sign in</a> to participate in the discussion</p>
             <!-- @endif -->
</div>

</template>
<script>
export default {
    ///remove pagination was introduced//  props: ['endpoint'],
    data() {
        return {
            body: '',
        };
    },
    computed: {
        // signedIn(){
        //     return window.App.signedIn;
        // }
    },
    methods: {
        addReply(){
            axios.post(location.pathname +'/replies', {body: this.body})
            ////end point was removed OR refactor/////// axios.post(this.endpoint, {body: this.body})
            .then(({data}) => {
                this.body = '';
                flash('your reply has been posted');
                this.$emit('created', data);
            });
        }
    }
}
</script>


