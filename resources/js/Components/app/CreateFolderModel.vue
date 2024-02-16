<template>
    {{ modalValue  }}
 <Modal :show="modalValue">

        <div>
            show model
        </div>
 </Modal>

</template>


<script setup>
    import Modal from "@/Components/Modal.vue";

    const {modalValue} = defineProps({
        modalValue : Boolean
    });

</script>

<style scoped>

</style>
