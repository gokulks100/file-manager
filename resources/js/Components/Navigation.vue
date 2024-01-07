<template>
  <nav class="min-w-[200px]">
    <div class="h-[80px] px-3 flex items-center gap-3">
        <Link :href="route('dashboard')">
            <ApplicationLogo
                class="block w-auto text-gray-800 fill-current h-9"
            />
        </Link>
        StoraPRo
    </div>
    <div class="px-3">
        <CreateNewDropdown/>
        <div class="py-3">
            <NavLink href="/" :active="true">My files</NavLink>
            <NavLink href="/" >Shared with Me</NavLink>
            <NavLink href="/">Shared by me</NavLink>
            <NavLink href="/">Trash</NavLink>

        </div>
    </div>
  </nav>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import CreateNewDropdown from '@/Components/app/CreateNewDropdown.vue'
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';

</script>

<style lang="scss" scoped>

</style>
