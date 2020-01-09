<script>
    export default {

        props: ['attributes'],
        data() {
            return {
                body: this.attributes.body,
                editing: false,
            }
        },
        methods: {
            save() {
                console.log(this.body)
                axios.patch('/replies/' + this.attributes.id, {
                    'body' : this.body
                }).then(function (response) {
                    // handle success
                })
                .catch(function (error) {
                    // handle error
                })
                this.editing = false
                flash('Updated')
            },
            remove() {
                console.log('deleting')
                axios.delete('/replies/' + this.attributes.id)
                $(this.$el).fadeOut(1000, () => {
                    flash('deleted')
                });
            }
        },

    }
</script>

<style>
    
</style>