<template>
    <!-- App.vue -->
    <v-app class="p-4">
        <v-navigation-drawer app> <!-- -->
            <v-list dense nav>
                <v-list-item
                    v-for="item in items"
                    :key="item.title"
                    :to="item.to"
                >
                    <v-list-item-icon>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <!-- Sizes your content based upon application components -->
        <v-main>
            <!-- Provides the application the proper gutter -->
            <v-container fluid>
                <router-view></router-view>
            </v-container>
        </v-main>

    </v-app>
</template>

<script>
import auth from "../api/auth";

export default {
    data() {
        return {
            items: this.menu(),
            right: null,
        }
    },
    created() {
        this.$bus.$on('logged', () => {
            this.items = this.menu()
        })
    },
    methods: {
        menu() {
            const menu = {
                0: [
                    {title: 'Login', icon: 'fas fa-sign-in-alt', to: '/login'},
                ],
                1: [
                    {title: 'Home', icon: 'fas fa-home', to: '/'},
                    {title: 'Logout', icon: 'fas fa-sign-out-alt', to: '/logout'},
                ]
            }

            return menu[auth.authenticated() ? 1 : 0];
        },
    },
}
</script>
