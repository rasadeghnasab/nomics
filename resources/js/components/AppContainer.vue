<template>
<!-- App.vue -->
<v-app> <v-navigation-drawer app> <!-- --> <v-list dense
        nav
      >
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
    export default {
        data () {
            return {
                items: [
                    { title: 'Login', icon: 'far fa-eye', 'to': '/login' },
                    { title: 'Register', icon: 'mdi-view-dashboard', 'to': '/register' },
                ],
                right: null,
            }
        },
        mounted() {
            console.log('App container mounted')
        }
    }
</script>
