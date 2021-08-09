<template>
    <main>
        <v-container fluid fill-height class="loginOverlay">
            <v-layout flex align-center justify-center>
                <v-flex xs12 sm4 elevation-6>
                    <v-toolbar class="pt-5 blue darken-4">
                        <v-toolbar-title class="white--text"><h4>Login</h4></v-toolbar-title>
                        <v-toolbar-items/>
                    </v-toolbar>
                    <v-card>
                        <v-card-text class="pt-4">
                            <div>
                                <v-form v-model="valid" ref="form">
                                    <v-text-field
                                        label="Email"
                                        v-model="email"
                                        :rules="emailRules"
                                        required
                                    ></v-text-field>
                                    <v-text-field
                                        label="Password"
                                        v-model="password"
                                        min="8"
                                        :type="e1 ? 'password' : 'text'"
                                        :rules="passwordRules"
                                        counter
                                        required
                                    ></v-text-field>
                                    <v-layout justify-space-between>
                                        <v-btn type="submit" @click="submit" :disabled="!valid" form="form"
                                               class="primary">Login
                                        </v-btn>
                                    </v-layout>
                                </v-form>
                            </div>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </main>
</template>

<script>
import auth from '../../api/auth.js';

export default {
    data() {
        return {
            valid: false,
            e1: true,
            password: '',
            passwordRules: [
                (v) => !!v || 'Password is required',
            ],
            email: '',
            emailRules: [
                (v) => !!v || 'E-mail is required',
                (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
            ],
        }
    },
    methods: {
        async submit() {
            if (!this.$refs.form.validate()) {
                return;
            }

            try {
                const response = await auth.login({
                    username: this.email,
                    password: this.password
                });

                if (response.data.error) {
                    this.$toaster.error(response.data.message);
                    return;
                }

                auth.saveAuthorizedUser(response.data.access_token);
                this.$bus.$emit('logged', 'User logged in')
                this.$router.push({path: '/'});

                this.$toaster.success('You logged in successfully.')
            } catch (error) {
                this.$toaster.error(error.response.data.message);
            }
        },
        clear() {
            this.$refs.form.reset()
        }
    },
}
</script>
