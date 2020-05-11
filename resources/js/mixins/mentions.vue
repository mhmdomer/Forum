<script>
export default {
    data() {
        return {
            mentions: []
        }
    },
    methods: {
        changing(data) {
            let lastWord = data.match(/\@([\w]+$)/)
            if(lastWord !== null) {
                let query = lastWord[0].substring(1)
                setTimeout(() => {
                    axios.get('/query/profiles/' + query)
                        .then(response => {
                            this.mentions = response.data
                            console.log(response.data)
                        })
                        .catch(error => {

                        })
                }, 500)
            } else {
                this.mentions = []
            }
        }
    },
}
</script>
