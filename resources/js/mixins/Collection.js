export default
    {
        data() {
            return {
                replies: [],
            };
        },
        methods: {

            add(item) {
                this.replies.push(item);
                this.$emit('added');
            },
            remove(index) {
                this.replies.splice(index, 1);
                this.$emit('removed');


            }
    }
}
