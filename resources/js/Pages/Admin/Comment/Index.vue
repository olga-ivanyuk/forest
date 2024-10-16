<template>
    <div class="main-container flex-auto">
        <div class="max-w-3xl mx-auto mt-8">
            <div class="mb-4">
                <Link :href="route('admin.comments.create')" class="btn-add">Add comment</Link>
            </div>
            <div class="mb-4">
                <Link :href="route('admin.index')" class="btn-back">Back
                </Link>
            </div>
            <div class="comments-grid">
                <div v-for="comment in comments" :key="comment.id" class="item-comment">
                    <div class="comment-content">{{ comment.content }}</div>
                    <div class="comment-profile">{{ comment.profile }}</div>
                    <div class="comment-post">{{ comment.post }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    name: "CommentsIndex",
    components: { Link },
    props: {
        comments: Array,
    },
};
</script>

<style scoped>
.comments-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-top: 1.5rem;
}

.comment-content {
    margin-bottom: 0.75rem;
}

.comment-profile {
    font-weight: bold;
    color: #38a169;
    margin-bottom: 0.5rem;
}

.comment-post {
    font-weight: bold;
    font-style: italic;
}

.item-comment {
    background-color: #f9f9f9;
    padding: 0.75rem;
    transition: background-color 0.3s ease;
    border-radius: 8px;
    margin-bottom: 6px;
    border: gray;
    width: 100%; /* Адаптивність */
    max-width: 800px; /* Встановлено ширину для запобігання надто великих блоків */
}
</style>
