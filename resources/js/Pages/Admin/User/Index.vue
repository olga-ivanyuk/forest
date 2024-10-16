<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Index",
    components: {Link},
    props: {
        users: Array
    },
}
</script>

<template>
    <div class="main-container">
        <div class="mx-auto w-1/2 pt-8">
            <div class="mb-4">
                <Link :href="route('admin.users.create')" class="btn-add">Add user</Link>
            </div>
            <div class="mb-4">
                <Link :href="route('admin.index')" class="btn-back">Back
                </Link>
            </div>
            <div class="users-grid">
                <div v-for="user in users" class="item">
                    <div class="user-name">
                        {{ user.name }} (profile: {{ user.profile }})
                    </div>
                    <div class="email">
                        {{ user.email }}
                    </div>
                    <div v-if="user.role" class="role">
                        {{ user.role }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.users-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-top: 1.5rem;
}

.user-name {
    font-weight: bold;
    color: #38a169;
    margin-bottom: 0.5rem;
}

.email {
    font-weight: bold;
    font-style: italic;
}
.role {
    font-weight: bold;
    color: #3182ce;
    background-color: #e2e8f0;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    display: inline-block;
    font-size: 0.875rem;
    margin-top: 1rem;
}
</style>
