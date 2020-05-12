<template>
    <input type="file" accept="image/*" @change="changed">
</template>

<script>
export default {
    data() {
        return {

        }
    },
    methods: {
        changed(e) {
            if(! e.target.files.length) return
            let file = e.target.files[0]
            let reader = new FileReader()
            reader.readAsDataURL(file)
            reader.onload = e => {
                let src = e.target.result
                this.$emit('loaded', {file, src})
            }
            // save on the server
            // this.save(file)
        }
    },
}
</script>
