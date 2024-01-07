<style scoped>

</style>
<template>
    <div class="flex w-full h-screen gap-4 bg-gray-50">
        <Navigation/>
        <main class="flex flex-col flex-1 px-4 overflow-hidden">
            <div class="flex items-center justify-between w-full">
                <SearchForm/>
                <UserSettingsDropDown/>
            </div>
            <div class="flex flex-col flex-1 overflow-hidden">
                <slot/>
            </div>
        </main>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import Navigation from '@/Components/Navigation.vue';
import UserSettingsDropDown from '@/Components/UserSettingsDropDown.vue';
import SearchForm from '@/Components/SearchForm.vue';

const showingNavigationDropdown = ref(false);
</script>
