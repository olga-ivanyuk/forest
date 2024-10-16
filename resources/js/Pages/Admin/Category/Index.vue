<template>
    <div class="main-container">
        <div class="max-w-3xl mx-auto mt-8">
            <div class="mb-4">
                <Link :href="route('admin.categories.create')" class="btn-add">Add
                    category
                </Link>
            </div>
            <div class="mb-4">
                <Link :href="route('admin.index')" class="btn-back">Back
                </Link>
            </div>
            <div v-for="category in categories" :key="category.id" class="item">
                <div>{{ category.title }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Index",
    components: {Link},
    props: {
        categories: Array,
    },
    data() {
        return {};
    },
};
</script>

<style scoped>

</style>
