<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Show",
    props: {
        post: Object
    },
    components: {
        Link
    },

    methods: {
        $router: undefined,
        deletePost() {
            // router.delete(route('admin.categories.store'), this.post.id)
            if (confirm("Are you sure you want to delete this post?")) {
                axios.delete(route('admin.posts.destroy', this.post.id))
                    .then(response => {
                        router.get(route('admin.posts.index'));
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },

    }
}
</script>

<template>
    <div class="main-container">
        <div class="mx-auto w-1/2 pt-8">
            <div class="button-group mb-4">
                <Link :href="route('admin.posts.create')" class="btn-add">Add post</Link>
                <Link :href="route('admin.posts.index')" class="btn-back">Back</Link>
                <!--                <Link :href="route('admin.posts.destroy', post)" class="btn-delete">Delete</Link>-->
                <button @click.prevent="deletePost(post.id)" class="btn-delete">Delete</button>
            </div>
            <div class="item">
                <h3>
                    {{ post.title }}
                </h3>
            </div>
            <div class="image-container mb-6">
                <img :src="post.image_url" alt="post.title" class="post-image">
            </div>
            <div>
                <p class="item">
                    {{ post.content }}
                </p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.button-group {
    display: flex;
    gap: 10px; /* Відстань між кнопками */
    justify-content: space-around; /* Розміщення кнопок по ширині */
}

.btn-add, .btn-back, .btn-delete {
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    color: white;
}

.btn-add {
    background-color: #28a745;
}

.btn-back {
    background-color: #007bff;
}

.btn-delete {
    background-color: #dc3545;
}

.btn-delete:hover {
    background-color: #ff1a1a;
}

.btn-delete:active {
    background-color: #e60000;
}

.post-image {
    max-width: 100%;
    max-height: 500px;
    object-fit: cover;
    border-radius: 10px;
}

.image-container {
    display: flex;
    justify-content: center;
}

.post-image {
    max-width: 100%;
    max-height: 500px;

}
</style>
