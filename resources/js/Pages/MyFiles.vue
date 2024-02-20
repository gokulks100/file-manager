<template>
    <Head title="File Manager" />
    <AuthenticatedLayout>
        <nav class="flex items-center justify-between p-1 mb-3">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li v-for="ans of ancestors.data" :key="ans.id" class="inline-flex items-center">
                    <Link v-if="!ans.parent_id" :href="route('myFiles')"
                          class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-700">
                        <HomeIcon class="w-4 h-4"/>
                        My Files
                    </Link>
                    <div v-else class="flex items-center">
                        <ChevronRightIcon class="w-6 h-6 text-gray-700" /> 
                        <Link :href="route('myFiles', {folder: ans.path})"
                              class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-700">
                            {{ ans.name }}
                        </Link>
                    </div>
                </li>
            </ol>
        </nav>
        <table class="min-w-full" v-if="files.data.length">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                        Name
                    </th>
                    <th class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                        Owner
                    </th>
                    <th class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                        Last Modified
                    </th>
                    <th class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                        Size
                    </th>
                    <th class="px-6 py-4 text-sm font-medium text-left text-gray-900">

                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="file of files.data" :key="file.id"
                    class="transition duration-300 ease-in-out bg-white border-b cursor-pointer hover:bg-gray-100"
                    @dblclick="openFolder(file)">

                    <td  class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                        {{  file.name }}
                    </td>
                    <td  class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                        {{  file.owner }}
                    </td>
                    <td  class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                        {{  file.updated_at }}
                    </td>
                    <td  class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                        {{  file.size }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-if="!files.data.length" class="py-8 text-sm text-center text-gray-400">
                There is no data in the folder
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { HomeIcon} from '@heroicons/vue/20/solid';
import { ChevronRightIcon } from "@heroicons/vue/20/solid"
import { Head, router,Link } from '@inertiajs/vue3';


const {files} =defineProps({
    files:Object,
    folder:Object,
    ancestors:Array
});

function openFolder(file)
{
    if(!file.is_folder)
    {
        return;
    }

    router.visit(route('myFiles',{folder:file.path}))

}



</script>

<style scoped>
</style>
