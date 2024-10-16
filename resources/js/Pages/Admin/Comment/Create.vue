<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Create",
    components: {
        Link
    },

    props: {
        posts: Array,
        profiles: Array
    },

    methods: {
        storeComment() {
            axios.post(route('admin.comments.store'), this.comment)
                .then(res => {
                    this.comment = {}
                })
        }
    },

    data() {
        return {
            comment: {}
        }
    },
}
</script>

<template>
    <div class="main-container">
        <div class="mx-auto w-1/2 pt-8">
            <div class="mb-4">
                <Link :href="route('admin.comments.index')" class="btn-back">
                    Back
                </Link>
            </div>
            <div>
                <div class="mb-4">
                    <textarea class="input-field" v-model="comment.content"
                              placeholder="content"></textarea>
                </div>
                <div class="mb-4">
                    <select class="input-field" v-model="comment.profile_id">
                        <option selected disabled :value="null">Choose profile</option>
                        <option v-for="profile in profiles" :value="profile.id">{{ profile.name }}</option>
                    </select>
                </div>
                <div class="mb-4">
                    <select class="input-field" v-model="comment.post_id">
                        <option selected disabled :value="null">Choose post</option>
                        <option v-for="post in posts" :value="post.id">{{ post.title }}</option>
                    </select>
                </div>
                <div class="mb-4">
                    <a @click.prevent="storeComment" href="#" class="btn-add">Add</a>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>
