<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Index",
    components: {Link},
    props: {
      tags: Array
    },

    data() {
        return {
        }
    }
}
</script>

<template>
    <div class="main-container">
        <div class="max-w-3xl mx-auto mt-8">
            <div class="mb-4">
                <Link :href="route('admin.tags.create')" class="btn-add">Add tag</Link>
            </div>
            <div class="mb-4">
                <Link :href="route('admin.index')" class="btn-back">Back
                </Link>
            </div>
            <div v-for="tag in tags" :key="tag.id" class="item">
                <div>{{ tag.title }}</div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
