<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3'

</script>
<template>

    <Head title="Tareas" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center space-x-4">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tareas</h2>
                <!-- <button type="button" @click="showModalCreate = true"
                    class="text-white bg-blue-600 hover:bg-[#3b5998]/90 focus:ring-4 focus:outline-none focus:ring-[#3b5998]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none"
                        stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="16"></line>
                        <line x1="8" y1="12" x2="16" y2="12"></line>
                    </svg>

                </button> -->
                <Link href="/task/create" method="get" as="button"
                    class="text-white bg-blue-600 hover:bg-[#3b5998]/90 focus:ring-4 focus:outline-none focus:ring-[#3b5998]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none"
                    stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="16"></line>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
                </Link>

            </div>

        </template>
        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- <form class="py-6">
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="search" id="search"
                                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Buscar ..." required />
                            </div>
                        </form> -->

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Titulo</th>
                                        <th scope="col" class="px-6 py-3">Descripción</th>
                                        <th scope="col" class="px-6 py-3">Status</th>
                                        <th scope="col" class="px-6 py-3">Fecha Finalización</th>
                                        <th scope="col" class="px-6 py-3">Archivos cargados</th>
                                        <th scope="col" class="px-6 py-3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b hover:bg-gray-50" v-for="task in tasks.data"
                                        :key="task.id">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ task.titleTask }}
                                        </th>
                                        <td class="px-5 py-4">{{ task.descriptionTask }}</td>
                                        <td class="px-6 py-4"
                                            :class="task.completed ? 'text-green-500' : 'text-red-500'">
                                            {{ task.completed ? 'Completada' : 'Incompleta' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ task.completedAtTask ? new
                                                Date(task.completedAtTask).toLocaleDateString() : '-'
                                            }}
                                        </td>
                                        <td class="px-6 py-4">{{ task.files_count }}</td>
                                        <td class="flex items-center px-6 py-4 space-x-4">
                                            <button type="button"
                                                class="font-medium text-blue-600 hover:underline focus:outline-none"
                                                v-on:click="editTask()">
                                                Editar
                                            </button>
                                            <button type="button"
                                                class="font-medium text-red-600 hover:underline focus:outline-none"
                                                v-on:click="deleteTask(task)">
                                                Eliminar
                                            </button>
                                            <button type="button" :class="{
                                                'bg-red-600 hover:bg-red-800 focus:ring-red-300': task.completed,
                                                'bg-green-600 hover:bg-green-800 focus:ring-green-300': !task.completed
                                            }" class="focus:outline-none text-white font-medium rounded-lg"
                                                v-on:click="toggleTaskCompletion(task)">
                                                {{ task.completed ? 'Marcar como incompleta' : 'Marcar como completada'
                                                }}
                                            </button>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <center>
                            <nav aria-label="Pagination" class="py-6">
                                <ul class="inline-flex -space-x-px text-base h-10">
                                    <li v-for="page in tasks.links" :key="page.label">
                                        <a :href="page.url"
                                            :class="['flex items-center justify-center px-4 h-10 leading-tight border', page.active ? 'text-blue-600 bg-blue-50 border-blue-300' : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700']">
                                            {{ decodeHtml(page.label) }}
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
    <!-- Modal -->
    <div id="popup-modal" tabindex="-1" :class="showModal ? 'flex' : 'hidden'"
        class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    v-on:click="showModal = false">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500">
                        ¿Estás seguro de que quieres eliminar la tarea <strong>"{{ this.taskDelete.id
                            }}"</strong>?
                    </h3>
                    <button type="button"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
                        v-on:click="confirmDelete()">
                        Confirmar
                    </button>
                    <button type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100"
                        v-on:click="showModal = false">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>


</template>
<script>
import { router } from '@inertiajs/vue3';

export default {
    
    data() {
        return {
            showModal: false,
            taskDelete: '',
            isTooltipVisible: false, // Estado para controlar la visibilidad del tooltip
            files: [], // Lista de archivos seleccionados

        };
    },
    props: {
        tasks: {
            required: true,
        },
    },
    methods: {
        showTooltip() {
            this.isTooltipVisible = true; // Mostrar el tooltip
        },
        hideTooltip() {
            this.isTooltipVisible = false; // Ocultar el tooltip
        },
        decodeHtml(html) {
            const txt = document.createElement('textarea');
            txt.innerHTML = html;
            return txt.value;
        },
        editTask() {
            // Lógica para la acción de editar
            console.log("Editar acción activada");
            // Puedes agregar lógica para redirigir o abrir un modal
        },
        deleteTask(selectedTask) {
            this.TaskDelete = selectedTask;
            this.showModal = true;
        },
        confirmDelete() {
            this.showModal = false;
            let idTask = Number(this.TaskDelete.id);
            router.delete(route('task.destroy', idTask), {
                forceFormData: true,
            })
        },
        toggleTaskCompletion(selectedTask) {
            // this.task.completed = !this.task.completed;
            console.log(selectedTask.id);
        },

        handleFiles(event) {
            const newFiles = Array.from(event.target.files);
            this.addFiles(newFiles);
        },
        handleDrop(event) {
            const newFiles = Array.from(event.dataTransfer.files);
            this.addFiles(newFiles);
        },
        addFiles(newFiles) {
            const filteredFiles = newFiles.filter((file) => {
                const isValidType = file.type === "application/pdf" || file.type.startsWith("image/jpeg");
                const isNotDuplicate = !this.files.find((f) => f.name === file.name && f.size === file.size);
                return isValidType && isNotDuplicate;
            });

            if (this.files.length + filteredFiles.length > 10) {
                alert("No puedes subir más de 10 archivos.");
                return;
            }

            this.files.push(...filteredFiles);
        },
        removeFile(index) {
            this.files.splice(index, 1);
        },
    },
};
</script>
