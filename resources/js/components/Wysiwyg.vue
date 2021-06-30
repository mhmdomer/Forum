<template>
    <div>
        <input id="trix" type="hidden" :name="name" :value="value" />
        <trix-editor
            ref="trix"
            input="trix"
            :placeholder="placeholder"
        ></trix-editor>
    </div>
</template>

<script>
import Trix from "trix";
export default {
    props: ["name", "value", "placeholder", "shouldClear"],
    mounted() {
        this.$refs.trix.addEventListener("trix-change", e => {
            this.$emit("input", e.target.innerHTML);
        });
        // clear the input field every time the 'shouldClear property changes'
        this.$watch("shouldClear", () => {
            this.$refs.trix.value = "";
        });
        // hide file picker
        this.$el.querySelector(".trix-button-group--file-tools").style.display =
            "none";
    }
};
</script>
