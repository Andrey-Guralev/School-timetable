<template>
    <div>
        <div class="header flex justify-between items-center">
            <h3 class="text-xl font-medium">
                Изменение классов
            </h3>
            <button v-on:click="openCreateModal" class="text-center h-8 w-2/12 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-800 hover:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Создать класс
            </button>
        </div>
        <div class="ml-8 flex classes flex-wrap mt-4">
            <button v-for="cl in classes" v-on:click="openEditModal(cl.id)" type="button" class="class-button text-blue-600 mr-4">
                {{ cl.number }}{{ cl.letter }}
            </button>
        </div>
        <div class="explanation ml-8 mt-4 text-gray-600">* Чтобы изменить или удалить класс, надо его выбрать</div>

        <edit-classes-modal ref="editModal" @updateParent="updateClasses"></edit-classes-modal>
        <create-classes-modal ref="createModal" @updateParent="updateClasses"></create-classes-modal>
    </div>
</template>

<script>
import EditClassesModal from "./EditClassesModal";
import CreateClassesModal from "./CreateClassesModal";

export default {
    name: "ClassesIndex",

    components: {
      EditClassesModal,
      CreateClassesModal
    },

    data() {
        return {
            classes: Object,
        };
    },

    methods: {

        getData: async function () {
            this.classes = (await axios.get('/classes/get').then().catch()).data;
        },

        openEditModal: function (e) {
            this.$refs.editModal.open = true;
            this.$refs.editModal.id = e;
            this.$refs.editModal.getData();
        },

        openCreateModal: function (e) {
            this.$refs.createModal.open = true;
        },

        updateClasses: function () {
            this.getData();
        },

    },

    mounted() {
        this.getData();
    }
}
</script>

<style scoped>

</style>
