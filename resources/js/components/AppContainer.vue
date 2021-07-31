<template>
<!-- App.vue -->

    <v-app>
    <v-navigation-drawer app>
        <!-- -->
        <v-card app>
    <v-navigation-drawer>
      <v-list
        dense
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
  </v-card>
    </v-navigation-drawer>

    <v-app-bar app>
        <h1>app bar</h1>
        <!-- -->
    </v-app-bar>

    <!-- Sizes your content based upon application components -->
    <v-main>

        <!-- Provides the application the proper gutter -->
        <v-container fluid>

        <!-- If using vue-router -->
        <router-view></router-view>
        </v-container>
    </v-main>

    <v-footer app>
        <!-- -->
    </v-footer>
    </v-app>
</template>

<script>
    export default {
        data () {
            return {
                items: [
                    { title: 'Login', icon: 'mdi-view-dashboard', 'to': '/auth/login' },
                    { title: 'Register', icon: 'mdi-view-dashboard', 'to': '/auth/register' },
                ],
                right: null,
            }
        },
        mounted() {
            console.log('App container mounted')
        }
    }
</script>
