<script>
import {Link} from "@inertiajs/vue3";
import {comment} from "postcss";

export default {
    name: "Show",
    props: {
        post: Object
    },

    data() {
        return {
            post: this.post,
            comment: {},
            childComment: {},
            visibleComments: 0,
            commentsPerPage: 5,
            showChildComment: null,
        }
    },

    components: {
        Link
    },

    computed: {
        visibleCommentsList() {
            return this.post.comments.slice(0, this.visibleComments);
        }
    },

    methods: {
        storeComment() {
            axios.post(route('posts.comments.store', this.post.id), this.comment)
                .then(res => {
                    console.log(res.data);
                    this.post.comments.push(res.data);
                    this.comment = {};
                    this.visibleComments = Math.min(this.visibleComments + 1, this.commentsPerPage);
                })
                .catch(error => {
                    console.error(error);
                });
        },

        showMoreComments() {
            this.visibleComments = Math.min(
                this.visibleComments + this.commentsPerPage,
                this.post.comments.length
            );
        },

        openChildComment(commentId) {
            this.showChildComment = commentId;
        },

        storeChildComment(parentCommentId) {
            this.childComment.parent_id = parentCommentId;
            axios.post(route('posts.comments.child.store', {
                post: this.post.id,
                comment: parentCommentId
            }), this.childComment)
                .then(res => {
                    const parentComment = this.post.comments.find(comment => comment.id === parentCommentId);
                    if (parentComment) {
                        parentComment.replies = parentComment.replies || [];
                        parentComment.replies.push(res.data);
                    }

                    this.childComment = {};
                    this.showChildComment = false;
                })
                .catch(error => {
                    console.error(error);
                })
        },

        toggleLike() {
            axios.post(route('posts.likes.toggle', this.post.id))
                .then(res => {
                    this.post.is_liked = res.data.is_liked;
                    this.post.liked_profiles_count = res.data.liked_profiles_count;
                })
                .catch(error => {
                    console.error('Error toggling like:', error);
                });
        },

        commentToggleLike(comment){
            axios.post(route('posts.comment.likes.toggle', [this.post, comment.id]))
                .then(res => {
                   comment.is_liked = res.data.is_liked;
                   comment.liked_profiles_count = res.data.liked_profiles_count;
                })
                .catch(error => {
                    console.error('Error toggling like:', error);
                });
        }
    }
}
</script>

<template>
    <div class="main-container bg-gray-100 min-h-screen py-8">
        <div class="post-container bg-white shadow-md rounded-lg mx-auto w-full md:w-2/3 lg:w-1/2 p-6">
            <div class="button-group mb-4">
                <Link :href="route('posts.index')" class="btn-back">Back</Link>
            </div>
            <div class="post-content mb-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ post.title }}</h2>
                <div class="image-container mb-4">
                    <img :src="post.image_url" alt="post.title" class="post-image rounded-lg shadow-sm">
                </div>
                <p class="text-gray-700 leading-relaxed">
                    {{ post.content }}
                </p>
            </div>
            <div class="mb-4 flex">
                <span>{{ post.liked_profiles_count }}</span>
                <svg @click="toggleLike" xmlns="http://www.w3.org/2000/svg" :fill="post.is_liked ? '#000' : 'none'" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                </svg>
            </div>
        </div>

        <div class="comment-form bg-white shadow-md rounded-lg mx-auto w-full md:w-2/3 lg:w-1/2 p-6 mt-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Add Comment</h3>
            <textarea v-model="comment.content" placeholder="Write your comment here..."
                      class="comment-textarea"></textarea>
            <div class="text-right mt-4">
                <a href="#" @click.prevent="storeComment"
                   class="btn-add">Add</a>
            </div>
        </div>

        <div class="comments-list mx-auto w-full md:w-2/3 lg:w-1/2 mt-6">
            <h3 class="text-xl font-medium text-gray-800 mb-4">
                Comments ({{ post.comments.length }})
            </h3>
            <div v-if="post.comments.length > 0">
                <div v-for="(comment, index) in visibleCommentsList" :key="comment.id" class="comment-container">
                    <div class="comment-content">
                        <p class="text-gray-800">{{ comment.content }}</p>
                        <div class="post-profile text-right">
                            By {{ comment.profile }} on {{ comment.created_at }}
                        </div>
                    </div>
                    <div class="mb-4 flex">
                        <span>{{ comment.liked_profiles_count }}</span>
                        <svg @click="commentToggleLike(comment)" xmlns="http://www.w3.org/2000/svg" :fill="comment.is_liked ? '#000' : 'none'" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                        </svg>
                    </div>
                    <div class="text-right mt-4">
                        <a href="#" @click.prevent="openChildComment(comment.id)"
                           class="btn-reply">Reply</a>
                    </div>
                    <div v-if="showChildComment === comment.id"
                         class="comment-form bg-white shadow-md rounded-lg mx-auto w-full md:w-2/3 lg:w-1/2 p-6 mt-6">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Add Comment</h3>
                        <textarea v-model="childComment.content" placeholder="Write your reply here..."
                                  class="comment-textarea"></textarea>
                        <div class="text-right mt-4">
                            <a href="#" @click.prevent="storeChildComment(comment.id)"
                               class="btn-add">Reply</a>
                        </div>
                    </div>

                    <!-- Display child comments if any -->
                    <div v-if="comment.replies" class="replies-list ml-4">
                        <div v-for="reply in comment.replies" :key="reply.id" class="comment-container">
                            <div class="comment-content">
                                <p class="text-gray-700">{{ reply.content }}</p>
                                <div class="post-profile text-right">
                                    By {{ reply.profile }} on {{ reply.created_at }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button v-if="visibleComments < post.comments.length" @click="showMoreComments"
                        class="btn-show-more">
                    Show more comments
                </button>
            </div>
            <div v-else class="text-gray-600">No comments yet.</div>
        </div>
    </div>
</template>

<style scoped>
.post-profile {
    font-weight: bold;
    color: #38a169;
    margin-top: 30px;
}

.post-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.btn-back {
    background-color: #007bff;
    color: white;
    padding: 8px 16px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.btn-back:hover {
    background-color: #0056b3;
}

.btn-reply {
    background-color: #2e5942;
    color: white;
    padding: 8px 16px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.post-image {
    max-width: 100%;
    max-height: 400px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.comment-form {
    background: #fff;
    padding: 16px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.comment-textarea {
    width: 100%;
    min-height: 100px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    resize: vertical;
    font-size: 14px;
}

.btn-add {
    display: inline-block;
    padding: 8px 16px;
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    text-decoration: none;
}

.btn-add:hover {
    background-color: #218838;
}

.comments-list {
    margin-top: 20px;
}

.comment-container {
    background: #fff;
    padding: 12px 16px;
    margin-bottom: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.comment-content p {
    margin: 0;
    font-size: 15px;
}

.comment-content .text-sm {
    font-size: 13px;
    color: #555;
    margin-top: 8px;
}
</style>
