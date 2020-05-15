let user = window.App.user

module.exports = {

    owns(model, key='user_id') {
        return model[key] == user.id
    },

    admin() {
        return user.admin == true
    }
}
