<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import Layout from '../Layout/Layout.vue';

defineProps({users: Array});
</script>

<template>
  <Layout>
    <h1>Hello</h1>
  <div v-for="(user, index) in users" :key="index">
    {{ user }}
    <br>
    <Link :href="`/users/${user}`">About</Link>
  </div>
  <Link href="/about">About</Link>

  </Layout>

</template>