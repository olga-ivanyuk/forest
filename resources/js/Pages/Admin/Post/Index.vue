<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Index",
    props: {
        tags: Array,
        categories: Array,
        posts: Object,
        post: Object
    },

    data() {
        return {
            filter: {
                title: '',
                content: '',
                published_at_from: '',
                category_title: '',
                profile_name: ''
            },
            postsData: this.posts,
            currentPage: 1,
            editPostId: null,

            entries: {
                post: {
                    title: '',
                    content: '',
                    category_id: null,
                },
                tags: [],
            }
        }
    },

    components: {
        Link
    },

    mounted() {
        const params = new URLSearchParams(window.location.search);
        const page = params.get('page') || 1;

        // set filter to this.filter
        this.filter = {
            title: params.get('title') || '',
            content: params.get('content') || '',
            published_at_from: params.get('published_at_from') || '',
            category_title: params.get('category_title') || '',
            profile_name: params.get('profile_name') || '',
        };

        this.currentPage = page;
        this.getPosts();
    },

    methods: {
        deletePost(id) {
            axios.delete(route('admin.posts.destroy', {post: id}))
                .then(res => {
                    // this.postsData = this.posts.filter(post => post.id !== id);
                    this.getPosts(1);
                })
                .catch(error => {
                    console.log(error);
                })
        },

        getPosts(page = 1) {
            this.currentPage = page
            axios.get(route('admin.posts.index'), {
                params: {
                    ...this.filter,
                    page: this.currentPage,
                }
            })
                .then(res => {
                    this.postsData = res.data; // special postfix data!!!
                    this.currentPage = res.data.meta.current_page;
                    const queryObject = {
                        ...this.filter,
                        page: this.currentPage,
                    };

                    // delete null parameters from queryObject
                    const cleanedQueryObject = Object.fromEntries(
                        Object.entries(queryObject).filter(([key, value]) => value)
                    );

                    const queryString = new URLSearchParams(cleanedQueryObject).toString();

                    // update URL with clean query string
                    window.history.pushState(
                        null,
                        '',
                        `${window.location.pathname}?${queryString}`
                    );
                })
        },

        previousPage() {
            if (this.currentPage > 1) {
                this.getPosts(this.currentPage - 1);
            }
        },

        nextPage() {
            if (this.currentPage < this.postsData.meta.last_page) {
                this.getPosts(this.currentPage + 1);
            }
        },

        resetFilters() {
            this.filter = {
                title: '',
                content: '',
                published_at_from: '',
                category_title: '',
                profile_name: '',
            };
            this.getPosts(1);
        },

        debounce(fn, delay) {
            let timeoutId;
            return function (...args) {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {
                    fn.apply(this, args);
                }, delay);
            };
        },

        changeEditPostId(id, categoryId, title, content, tags) {
            this.editPostId = id;
            this.entries = {
                post: {
                    title: title,
                    content: content,
                    category_id: categoryId,
                },
                tags: tags.map(tag => tag.title),
            };
        },

        updatePost(id) {
            this.editPostId = null;
            axios.post(route('admin.posts.update', id), this.entries)
                .then(res => {
                    this.getPosts(1);
                })
                .catch(error => {
                    console.error(error);
                });
        },

        isEdit(id) {
            return this.editPostId === id;
        }
    },

    watch: {
        filter: {
            handler: function () {
                this.getPosts(1);
            },
            deep: true
        }
    }
}
</script>

<template>
    <div class="main-container">
        <div class="mx-auto w-1/2 pt-8">
            <div class="mb-4 flex gap-4">
                <div class="mb-4">
                    <Link :href="route('admin.posts.create')" class="btn-add">Add post</Link>
                </div>
                <div class="mb-4">
                    <Link :href="route('admin.index')" class="btn-back">Back
                    </Link>
                </div>
                <div class="mb-4">
                    <a @click.prevent="resetFilters" href="#" class="btn-reset">Reset</a>
                </div>
            </div>
            <div class="mb-4 flex justify-between items-center">
                <div>
                    <input type="text" class="border border-gray-200" v-model="filter.title" placeholder="title">
                </div>
                <div>
                    <input type="text" class="border border-gray-200" v-model="filter.content" placeholder="content">
                </div>
                <div>
                    <input class="border border-gray-200" v-model="filter.published_at_from" type="date">
                </div>
                <div>
                    <input type="text" class="border border-gray-200" v-model="filter.category_title"
                           placeholder="category_title">
                </div>
                <div>
                    <input type="text" class="border border-gray-200" v-model="filter.profile_name"
                           placeholder="profile_name">
                </div>
                <!--                <div>-->
                <!--                    <a @click.prevent="getPosts(1)" href="#"-->
                <!--                       class="btn-filter">Filter</a>-->
                <!--                </div>-->
            </div>
            <template v-for="post in postsData.data" :key="post.id">
                <div class="item" :class="isEdit(post.id) ? 'hidden' : ''">
                    <div class="tags-container">
                        <div v-for="tag in post.tags" class="tag-item">
                            #{{ tag.title }}
                        </div>
                    </div>
                    <Link :href="route('admin.posts.show', post.id)">
                        <div class="text-amber-900 text-right">
                            Category: {{ post.category }}
                        </div>
                        <div>{{ post.id }}</div>
                        <div>{{ post.title }}</div>
                        <div>{{ post.content }}</div>
                        <div class="post-profile">
                            Profile: {{ post.profile.name }} <br> by {{ post.profile.user }}
                        </div>
                        <div class="text-amber-900 text-right">
                            {{ post.published_at }}
                        </div>
                    </Link>
                    <a href="#" @click.prevent="deletePost(post.id)" class="btn-delete">Delete</a>
                    <a href="#" @click.prevent="changeEditPostId(post.id, post.category_id, post.title, post.content, post.tags)"
                       class="btn-edit">Edit</a>
                </div>
                <div :class="isEdit(post.id) ? '' : 'hidden'">
                    <select class="input-field mb-2" v-model="entries.post.category_id">
                        <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
                    </select>
                    <div class="mb-2"><input type="text" class="input-field" v-model="entries.post.title"></div>
                    <div><textarea class="input-field" v-model="entries.post.content"></textarea></div>
                    <select class="input-field mb-4" v-model="entries.tags" multiple>
                        <option value="">-</option>
                        <option v-for="tag in tags" :value="tag.title">{{ tag.title }}</option>
                    </select>
                    <div class="mb-4">
                        <a href="#" @click.prevent="updatePost(post.id)" class="btn-edit">Update</a>
                    </div>
                </div>
            </template>
            <div>
                <div v-if="postsData.data.length > 0">
                    <div v-if="postsData.data.length > 0">
                        <a v-for="link in postsData.meta.links"
                           :key="link.label"
                           @click.prevent="getPosts(link.label)"
                           class="inline-block py-1 px-2 border border-gray-200 mr-2"
                           :class="{ 'bg-gray-600 text-white': link.active, 'bg-gray-200': !link.active }"
                           href="#"
                        >
                            {{ link.label.replaceAll('&amp;laquo;', '').replaceAll('&amp;raquo;', '') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

.post-profile {
    font-weight: bold;
    color: #38a169;
    margin-top: 30px;
}

.tags-container {
    justify-content: center;
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    text-align: center;
}

.tag-item {
    background-color: #f0ad4e;
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 0.9em;
}

.btn-delete {
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    color: white;
    margin: 2px;
    background-color: #dc3545;
}

.btn-delete:hover {
    background-color: #ff1a1a;
}

.btn-delete:active {
    background-color: #e60000;
}

.btn-filter {
    border-radius: 5px;
    text-align: center;
    padding: 10px 20px;
    text-decoration: none;
    color: white;
    background-color: #26432c;
}

.btn-reset {
    border-radius: 8px;
    text-align: center;
    padding:  0.5rem 1rem;
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

.btn-edit {
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    color: white;
    background-color: #2f5e45;
}
</style>
