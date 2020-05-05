<template>
    <li @click="toggle" v-on-clickaway="away" class="relative cursor-pointer">
        Browse <i class="fa fa-sort-down"></i>
        <div class="menu rounded p-3 w-40 bg-gray-100 text-gray-900" v-show="isDropdownActive">
            <li><a href="" class="text-gray-700">Lorem ipsum dolor, sit amet consectetur</a></li>
            <li><a href="">test</a></li>
            <li><a href="">test</a></li>
        </div>
    </li>
</template>

<script>
import {
    mixin as clickaway
} from "vue-clickaway";
export default {
    props: ['title', ''],
    mixins: [clickaway],
    data() {
        return {
            isDropdownActive: false
        };
    },
    methods: {
        away() {
            this.isDropdownActive = false;
        },
        toggle() {
            this.isDropdownActive = !this.isDropdownActive
        }
    }
};
</script>

<style>

.menu {
    position: absolute;
    top: 2rem;
    max-width: 20rem;
}

</style>
