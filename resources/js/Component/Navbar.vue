<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <Link class="navbar-brand" href="/">Navbar</Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <Link class="nav-link" href="/">Home</Link>
                    <Link class="nav-link" href="/question">Question</Link>

                    <Link class="nav-link" href="/about">About</Link>
                </div>
            </div>
        </div>
    </nav>
</template>

<style lang=""></style>
