<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Create",
    components: {
        Link
    },

    props: {
        roles: Array,
    },

    methods: {
        storeUser() {
            axios.post(route('admin.users.store'), this.user)
                .then(res => {
                    this.user = {}
                })
        },

        togglePasswordVisibility() {
            this.showPassword = !this.showPassword;
        },
    },

    data() {
        return {
            showPassword: false,
            user: {
                role: null,
                password: '',
            }
        }
    },
}
</script>

<template>
    <div class="main-container">
        <div class="mx-auto w-1/2 pt-8">
            <div class="mb-4">
                <Link :href="route('admin.users.index')" class="btn-back">
                    Back
                </Link>
            </div>
            <div>
                <div class="mb-4">
                    <input type="text" class="input-field" v-model="user.name" placeholder="name">
                </div>
                <div class="mb-4">
                    <input type="text" class="input-field" v-model="user.email" placeholder="email">
                </div>
                <div class="mb-4 relative">
                    <input :type="showPassword ? 'text' : 'password'" class="input-field" v-model="user.password"
                           placeholder="password">

                    <span @click="togglePasswordVisibility" class="eye-icon">
                      <i :class="showPassword ? 'fa fa-eye-slash' : 'fa fa-eye'"></i>
                    </span>
                </div>
                <div class="mb-4">
                    <select class="input-field" v-model="user.role">
                        <option selected disabled hidden="hidden" :value="null">Choose role</option>
                        <option v-for="role in roles" :value="role.id">{{ role.name }}</option>
                    </select>
                </div>
                <div class="mb-4">
                    <a @click.prevent="storeUser" href="#" class="btn-add">Add</a>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Стиль поля вводу */
.input-field {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
    box-sizing: border-box;
}

.input-field:focus {
    border-color: #4A90E2;
    outline: none;
}

.eye-icon {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 1.2rem;
    color: #888;
}

</style>
