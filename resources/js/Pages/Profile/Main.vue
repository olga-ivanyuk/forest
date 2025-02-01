<template>
    <div class="profile-page">
        <div class="container mx-auto pt-8">

            <div class="logout-container mb-4 flex justify-between">
                <!-- Кнопка головна -->
                <Link :href="route('posts.index')" class="btn-home">Головна</Link>
                <!-- Кнопка логаут -->
                <button class="btn-reset" @click="logout">Logout</button>
            </div>
            <h1 class="post-profile">Welcome to Your Profile, {{ user.name }}</h1>

            <!-- Секція постів -->
            <div class="posts-section mb-8">
                <h2>Your Posts</h2>
                                <div v-if="postsData.length > 0" class="tags-container">
                                    <div v-for="post in postsData" :key="post.id" class="tag-item">
                                        <h3>{{ post.title }}</h3>
                                        <p>{{ post.content }}</p>
                                        <div class="post-actions">
<!--                                            <button class="btn-edit" @click="editPost(post.id)">Edit</button>-->
<!--                                            <button class="btn-delete" @click="deletePost(post.id)">Delete</button>-->
                                        </div>
                                    </div>
                                </div>
                                <p v-else>No posts available.</p>
            </div>

            <!-- Секція коментарів -->
            <div class="comments-section mb-8">
                                <h2>Your Comments</h2>
                                <div v-if="comments.length > 0" class="tags-container">
                                    <div v-for="comment in comments" :key="comment.id" class="tag-item">
                                        <p>{{ comment.content }}</p>
                                        <!-- Виведення поста, до якого належить коментар -->
                                        <small>Commented on post: "{{ comment.post.title }}"</small>
                                    </div>
                                </div>
                                <p v-else>No comments available.</p>
            </div>
            <!-- Секція лайкнутих постів -->
            <div class="liked-posts-section mb-8">
                <h2>Your Liked Posts</h2>
                <div v-if="likedPosts.length > 0" class="tags-container">
                    <div v-for="post in likedPosts" :key="post.id" class="tag-item">
                        <p>{{ post.title }}</p> <!-- Заголовок посту -->
                        <small>Liked on: {{ post.created_at }}</small>
                    </div>
                </div>
                <p v-else>No liked posts available.</p>
            </div>

            <!-- Секція лайкнутих коментарів -->
            <div class="liked-comments-section mb-8">
                <h2>Your Liked Comments</h2>
                <div v-if="likedComments.length > 0" class="tags-container">
                    <div v-for="comment in likedComments" :key="comment.id" class="tag-item">
                        <p>{{ comment.text }}</p> <!-- Текст коментаря -->
                        <small>Liked on: {{ comment.created_at }}</small>
                        <p>Commented on post: "{{ comment.post.title }}"</p> <!-- Назва посту, до якого належить коментар -->
                    </div>
                </div>
                <p v-else>No liked comments available.</p>
            </div>
        </div>
    </div>
</template>

<script>
import {Link, router} from "@inertiajs/vue3";
export default {
    name: "Main",
    components: {Link},
    props: {
        user: Object,
        posts: Object,
        comments: Array,
        likedPosts: Array,
        likedComments: Array,
    },

    data() {
        return {
            postsData: this.posts,
        };
    },

    methods: {
        fetchPosts() {
            axios.get(route('profiles.posts'))
                .then(res => {
                    this.postsData = res.data.posts;
                })
                .catch(error => {
                    console.error('Failed to fetch posts:', error);
                });
        },

        logout() {
            router.post(route('logout'));
        }
    },

    mounted() {
        this.fetchPosts();
    },

    watch: {
        posts(newVal) {
            this.postsData = newVal;
        }
    },
}
</script>

<style scoped>
.btn-home {
    padding: 8px 12px;
    background-color: #3498db;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.btn-home:hover {
    background-color: #2980b9;
}

.profile-page {
    background-color: #e9f7f4;
    padding: 20px;
    min-height: 100vh;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.post-profile {
    font-weight: bold;
    color: #38a169;
    margin-top: 40px;
    text-align: center; /* Центрує текст */
    font-size: 2.5rem; /* Збільшує розмір шрифту */
}

.tags-container {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    text-align: center;
    justify-content: center;
}

.tag-item {
    background-color: #f0ad4e;
    color: white;
    padding: 10px 15px;
    border-radius: 4px;
    font-size: 0.9em;
    margin: 5px;
}

.btn-delete {
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    color: white;
    margin: 5px;
    background-color: #dc3545;
}

.btn-delete:hover {
    background-color: #ff1a1a;
}

.btn-delete:active {
    background-color: #e60000;
}

.btn-edit {
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    color: white;
    background-color: #2f5e45;
}

.btn-reset {
    border-radius: 8px;
    padding: 0.5rem 1rem;
    text-decoration: none;
    color: white;
    background-color: #6c757d;
    transition: background-color 0.3s ease;
}

.btn-reset:hover {
    background-color: #5a6268;
}

.btn-reset:active {
    background-color: #495057;
}

.logout-container {
    margin-bottom: 30px;
}

.posts-section,
.comments-section {
    margin-top: 30px;
}

h2 {
    font-size: 1.5em;
    margin-bottom: 10px;
}
</style>
