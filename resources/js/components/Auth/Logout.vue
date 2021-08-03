<template>
    <main>
        <h1>Logging out ...</h1>
    </main>
</template>

<script>
import auth from '../../api/auth.js';

export default {
    async mounted() {
        try {
            const response = await auth.logout();

            auth.clearAuthorizedUser();

            await this.$router.push({path: '/login'});
            this.$bus.$emit('logged', 'User logged out')

            this.$toaster.success(response.data.message)
        } catch (error) {
            this.$toaster.success(error.response.message);
        }
    }
}
</script>
