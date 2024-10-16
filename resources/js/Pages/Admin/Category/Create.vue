<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Create",
    components: {
        Link
    },

    methods: {
        storeCategory() {
            axios.post(route('admin.categories.store'), this.category)
                .then(res => {
                    this.category = {}
                })
        }
    },

    data() {
        return {
            category: {}
        }
    },
}
</script>

<template>
    <div class="main-container">
        <div class="mx-auto w-1/2 pt-8">
            <div class="mb-4">
                <Link :href="route('admin.categories.index')" class="btn-back">
                    Back
                </Link>
            </div>
            <div>
                <div class="mb-4">
                    <input type="text" class="input-field" v-model="category.title"
                           placeholder="title">
                </div>
                <div class="mb-4">
                    <a @click.prevent="storeCategory" href="#" class="btn-add">Add</a>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>
