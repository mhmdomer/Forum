<template>
<div>
    <form v-if="canUpdate">
        <image-upload name="avatar" @loaded="loaded"></image-upload>
        <button type="submit" class="button">Add</button>
    </form>
    <img :src="avatar" alt="avatar" class="w-20 h-20 rounded-full">
</div>
</template>

<script>
import ImageUpload from './ImageUpload'
export default {
    props: ['user'],
    components: { ImageUpload },
    data() {
        return {
            avatar: this.user.avatar,
        }
    },
    computed: {
        canUpdate() {
            return this.authorize(user => user.id === this.user.id)
        }
    },
    methods: {
        loaded(avatar) {
            this.avatar = avatar.src
            this.save(avatar.file)
        },
        save(file) {
            let data = new FormData()
            data.append('avatar', file)
            axios.post('/api/users/' + this.user.id +'/avatar', data)
                .then(response => {
                    flash('Image Uploaded Successfully')
                })
                .catch(e => {
                    this.avatar = this.user.avatar
                    flash('error uploading', 'danger')
                })
        }
    },
}
</script>
