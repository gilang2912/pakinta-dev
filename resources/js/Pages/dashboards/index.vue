<script>
import { Head, Link } from '@inertiajs/vue3'
import Layout from '@/Layouts/main.vue'
import PageHeader from '@/Components/page-header.vue'

export default {
    components: {
        Head,
        Layout,
        PageHeader,
        Link
    }
}
</script>

<template>
    <Layout>
        <Head title="Dashboard" />
        <PageHeader title="Dashboard" pageTitle="Home" />
    </Layout>
</template>
