<template>
    <div style="width: 120px; height: 120px" class="rounded-circle position-relative d-inline-block overflow-hidden">
        <input
            type="file"
            accept="image/*"
            class="hide"
            ref="file"
            @change="change"
        />
        <img :src="src" alt="Avatar" class="h-100 w-100"/>
        <div
            class="position-absolute h-100 w-100 bg-dark d-flex align-items-center justify-content-center"
            style="top:0; opacity: 75%"
        >
            <button
                type="button"
                @click="browse()"
                class="rounded-circle text-white"
            >
                <icon name="camera" class=""></icon>
            </button>
            <button
                type="button"
                v-if="value"
                @click="remove()"
                class="rounded-circle"
            >
                <icon name="x" class="h-6 w-6"></icon>
            </button>
        </div>
    </div>
</template>

<script>
import Icon from "./Icon";

export default {
    props: {
        value: File,
        defaultSrc: String,
    },
    watch: {
        value(file) {
            if (!file) {
                this.src = this.defaultSrc;
                this.$refs.file.value = "";
            } else {
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = (e) => {
                    this.src = e.target.result;
                };
            }
        },
    },
    data() {
        return {
            src: this.defaultSrc,
        };
    },
    methods: {
        browse() {
            this.$refs.file.click();
        },
        remove() {
            this.$emit("input", null);
        },
        change(e) {
            this.$emit("input", e.target.files[0]);
        },
    },
    components: {
        Icon,
    },
};
</script>
