<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Create",
    components: {
        Link
    },

    props: {
        categories: Array,
    },

    methods: {
        storePost() {
            axios.post(route('admin.posts.store'), this.entries, {
                headers: {'content-type': 'multipart/form-data'}
            })
                .then(res => {
                    this.entries = {
                        post: {
                            category_id: null,
                        },
                        tags: '',
                    };
                    this.$refs.fileInput.value = '';
                })
        },

        setImage(e) {
            this.entries.post.image = e.target.files[0]
        },

        openCalendar(event) {
            event.target.showPicker();
        },
    },

    data() {
        return {
            entries: {
                post: {
                    category_id: null,
                },
                tags: '',
            }
        }
    },
}
</script>

<template>
    <div class="main-container">
        <div class="mx-auto w-1/2 pt-8">
            <div class="mb-4">
                <Link :href="route('admin.posts.index')" class="btn-back">Back
                </Link>
            </div>
            <div>
                <div class="mb-4">
                    <input type="text" class="input-field" v-model="entries.post.title" placeholder="title">
                </div>
                <div class="mb-4">
                    <textarea class="input-field" v-model="entries.post.content"
                              placeholder="content"></textarea>
                </div>
                <div class="mb-4">
                    <input @focus="openCalendar" type="datetime-local" class="input-field" v-model="entries.post.published_at"
                           placeholder="published_at">
                </div>
                <div class="mb-4">
                    <select class="input-field" v-model="entries.post.category_id">
                        <option hidden="hidden" :value="null">Choose category</option>
                        <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
                    </select>
                </div>
                <div class="mb-4">
                    <input type="text" class="input-field" v-model="entries.tags" placeholder="tags">
                </div>
                <div class="mb-4">
                    <input type="file" ref="fileInput" placeholder="image" @change="setImage">
                </div>
                <div class="mb-4">
                    <a @click.prevent="storePost" href="#"
                       class="btn-add">Add</a>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
