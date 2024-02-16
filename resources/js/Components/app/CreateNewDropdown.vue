<template>
    <!-- <CreateFolderModel/> -->
    <Menu as="div" class="relative block mb-2 text-left">
        <MenuButton
            class="flex justify-center w-full px-8 py-2 text-sm font-medium text-gray-900 border rounded-md shadow-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75 hover:bg-gray-200"
        >
            Create New
            <ChevronDownIcon
                class="w-5 h-5 ml-2 -mr-1 text-violet-200 hover:text-violet-100"
                aria-hidden="true"
            />
        </MenuButton>

        <transition
            enter-active-class="transition duration-100 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-in"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0"
        >
            <MenuItems
                class="absolute min-w-[170px] mt-2 items-center origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black/5 focus:outline-none"
            >
                <div class="px-4 py-2">
                    <MenuItem v-slot="{ active }">
                        <a
                            href="#"
                            @click.prevent="showCreateFolderModal"
                            :class="[
                                active
                                    ? 'text-indigo-700 bg-indigo-200'
                                    : 'text-gray-900',
                                'group flex w-full items-center rounded-md px-4 py-2 text-sm',
                            ]"
                        >
                            New Folder
                        </a>
                    </MenuItem>
                </div>
                <div class="px-4 py-2">
                    <MenuItem v-slot="{ active }">
                        <a
                            :class="[
                                active
                                    ? 'text-indigo-700 bg-indigo-200'
                                    : 'text-gray-900',
                                'group flex w-full items-center rounded-md px-4 py-2 text-sm',
                            ]"
                        >
                            Upload Files
                        </a>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                        <a
                            :href="route('dashboard')"
                            :class="[
                                active
                                    ? 'text-indigo-700 bg-indigo-200'
                                    : 'text-gray-900',
                                'group flex w-full items-center rounded-md px-4 py-2 text-sm',
                            ]"
                        >
                            Upload Folder
                        </a>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>

    <!-- //modal -->
    <Modal :show="folderModal" max-width="sm">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">Create New Folder</h2>
            <div class="mt-6">
                <InputLabel
                    for="folderName"
                    value="Folder Name"
                    class="sr-only"
                />
                <TextInput
                    type="text"
                    id="folderName"
                    v-model="form.name"
                    ref="folderNameInput"
                    class="block w-full mt-1"
                    :class="
                        form.errors.name
                            ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
                            : ''
                    "
                    placeholder="Folder Name"
                    @keyup.enter="createFolder"
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>
        </div>
        <div class="flex justify-end gap-4 px-6 pb-5">
            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
            <PrimaryButton
                @click="createFolder"
                :class="{ 'opacity:25': form.processing }"
                :disabled="form.processing"
                >Submit</PrimaryButton
            >
        </div>
    </Modal>
</template>

<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/20/solid";
import CreateFolderModel from "@/Components/app/CreateFolderModel.vue";
import { ref } from "vue";
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { nextTick } from "vue";

//uses
const form = useForm({
    name: "",
    parent_id :null
});

//page

const page = usePage();

// refs
const folderModal = ref(false);
const folderNameInput = ref(null);

//methods

function showCreateFolderModal() {
    folderModal.value = true;
   nextTick(()=>folderNameInput.value.focus())
}

//create folder

function createFolder() {
    form.parent_id = page.props.folder.id;
    form.post(route('folder.create'),{
        preserveScroll:true,
        onSuccess: () =>{
            closeModal();
        },
        onError: ()=>{
            folderNameInput.value.focus()
        }
    });
}

function closeModal() {
    folderModal.value = false;
    form.reset();
    form.clearErrors();
}
</script>
