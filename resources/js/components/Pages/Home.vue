<template>
    <h1>Home</h1>
</template>

<script>
import auth from '../../api/auth';

export default {
    beforeMount() {
        if (!auth.authenticated()) {
            this.$router.push({path: '/login'})
        }
    }
}
</script>
