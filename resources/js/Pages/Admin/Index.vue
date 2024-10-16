<script>

import {defineComponent} from "vue";
import {Link} from "@inertiajs/vue3";

export default defineComponent({
    components: {Link}
})
</script>

<template>
    <div class="main-container">
        <div class="mx-auto w-1/2 pt-8">
            <div class="mb-8 page-title">
               Главная для админа
            </div>
            <div class="mb-4">
                <Link :href="route('admin.users.index')" class="btn-add">All users</Link>
            </div>
            <div class="mb-4">
                <Link :href="route('admin.posts.index')" class="btn-add">All posts</Link>
            </div>
            <div class="mb-4">
                <Link :href="route('admin.categories.index')" class="btn-add">All categories</Link>
            </div>
            <div class="mb-4">
                <Link :href="route('admin.tags.index')" class="btn-add">All tags</Link>
            </div>
            <div class="mb-4">
                <Link :href="route('admin.comments.index')" class="btn-add">All comments</Link>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
