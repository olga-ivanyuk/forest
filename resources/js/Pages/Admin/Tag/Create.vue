<script>
import {Link} from "@inertiajs/vue3";
export default {
    name: "Create",
    components: {
        Link
    },

    methods: {
        storeTag() {
            axios.post(route('admin.tags.store'), this.tag)
                .then(res => {
                    this.tag = {}
                })
        }
    },

    data() {
        return {
            tag: {}
        }
    },
}
</script>

<template>
    <div class="main-container">
        <div class="mx-auto w-1/2 pt-8">
            <div class="mb-4">
                <Link :href="route('admin.tags.index')" class="btn-back">
                    Back
                </Link>
            </div>
            <div>
                <div class="mb-4">
                    <input type="text" class="input-field" v-model="tag.title"
                           placeholder="title">
                </div>
                <div class="mb-4">
                    <a @click.prevent="storeTag" href="#" class="btn-add">Add</a>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>
