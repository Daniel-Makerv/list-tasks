
<template>

    <Head title="Editar Tarea" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center space-x-4">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Tarea: <strong class="text-blue-600">{{ form.title }}</strong></h2>
            </div>

        </template>
        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <!-- contenido -->
                            <div class="p-4 md:p-5">
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="name"
                                            class="block mb-2 text-sm font-medium text-gray-900">Titulo</label>
                                        <input type="text" name="name" id="name" v-model="form.title"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Titulo de la tarea" required />
                                    </div>
                                    <div class="text-red-600" v-if="errors.title">{{ errors.title }}</div>
                                    <div class="col-span-2">
                                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">
                                            Descripción</label>
                                        <textarea id="description" rows="4" v-model="form.description"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Descripción de la tarea"></textarea><br>
                                        <div class="text-red-600" v-if="errors.description">{{ errors.description }}
                                        </div>
                                    </div>

                                    <button @mouseenter="showTooltip" @mouseleave="hideTooltip" type="button"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Sube tus nuevos archivos
                                    </button>

                                    <!-- Tooltip -->
                                    <div v-show="isTooltipVisible"
                                        class="absolute z-10 inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm tooltip dark:bg-gray-700"
                                        role="tooltip">
                                        Solo podras subir archivos PDF y JPG y no archivos repetidos
                                    </div>


                                    <!-- drag on drop -->
                                    <div class="col-span-2 flex flex-col items-center justify-center w-full">
                                        <label for="dropzone-file"
                                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100"
                                            @dragover.prevent @drop.prevent="handleDrop">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                </svg>
                                                <p class="mb-2 text-sm text-gray-500">
                                                    <span class="font-semibold">Click para subir</span> o arrastrar y
                                                    soltar
                                                </p>
                                                <p class="text-xs text-gray-500">PDF, JPG (MAX. 10 archivos)</p>
                                            </div>
                                            <input id="dropzone-file" type="file" class="hidden" @change="handleFiles"
                                                accept=".pdf,.jpg,.jpeg" multiple />
                                        </label>

                                        <h1 class="py-8">Archivos cargados:</h1>

                                        <div class="mt-4 grid grid-cols-2 gap-4">
                                            <!-- card files -->
                                            <div class="leading-1.5 flex w-full max-w-[320px] flex-col"
                                                v-for="(file, index) in form.files" :key="index">
                                                <div class="flex items-start bg-gray-50 rounded-xl p-2">
                                                    <div class="me-2">
                                                        <span
                                                            class="flex items-center gap-2 text-sm font-medium text-gray-900 pb-2">
                                                            <!-- Mostrar SVG si el tipo de archivo es application/pdf -->
                                                            <svg v-if="file.file_type === 'pdf'" fill="none"
                                                                aria-hidden="true" class="w-5 h-5 flex-shrink-0"
                                                                viewBox="0 0 20 21">
                                                                <g clip-path="url(#clip0_3173_1381)">
                                                                    <path fill="#E2E5E7"
                                                                        d="M5.024.5c-.688 0-1.25.563-1.25 1.25v17.5c0 .688.562 1.25 1.25 1.25h12.5c.687 0 1.25-.563 1.25-1.25V5.5l-5-5h-8.75z" />
                                                                    <path fill="#B0B7BD"
                                                                        d="M15.024 5.5h3.75l-5-5v3.75c0 .688.562 1.25 1.25 1.25z" />
                                                                    <path fill="#CAD1D8"
                                                                        d="M18.774 9.25l-3.75-3.75h3.75v3.75z" />
                                                                    <path fill="#F15642"
                                                                        d="M16.274 16.75a.627.627 0 01-.625.625H1.899a.627.627 0 01-.625-.625V10.5c0-.344.281-.625.625-.625h13.75c.344 0 .625.281.625.625v6.25z" />
                                                                    <path fill="#fff"
                                                                        d="M3.998 12.342c0-.165.13-.345.34-.345h1.154c.65 0 1.235.435 1.235 1.269 0 .79-.585 1.23-1.235 1.23h-.834v.66c0 .22-.14.344-.32.344a.337.337 0 01-.34-.344v-2.814zm.66.284v1.245h.834c.335 0 .6-.295.6-.605 0-.35-.265-.64-.6-.64h-.834zM7.706 15.5c-.165 0-.345-.09-.345-.31v-2.838c0-.18.18-.31.345-.31H8.85c2.284 0 2.234 3.458.045 3.458h-1.19zm.315-2.848v2.239h.83c1.349 0 1.409-2.24 0-2.24h-.83zM11.894 13.486h1.274c.18 0 .36.18.36.355 0 .165-.18.3-.36.3h-1.274v1.049c0 .175-.124.31-.3.31-.22 0-.354-.135-.354-.31v-2.839c0-.18.135-.31.355-.31h1.754c.22 0 .35.13.35.31 0 .16-.13.34-.35.34h-1.455v.795z" />
                                                                    <path fill="#CAD1D8"
                                                                        d="M15.649 17.375H3.774V18h11.875a.627.627 0 00.625-.625v-.625a.627.627 0 01-.625.625z" />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_3173_1381">
                                                                        <path fill="#fff" d="M0 0h20v20H0z"
                                                                            transform="translate(0 .5)" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>

                                                            <!-- Mostrar otro SVG si el tipo de archivo no es application/pdf -->
                                                            <svg v-else xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                                                <circle cx="8.5" cy="8.5" r="1.5" />
                                                                <path d="M20.4 14.5L16 10 4 20" />
                                                            </svg>
                                                            {{ file.file_name }}
                                                        </span>
                                                        <span class="flex text-xs font-normal text-gray-500 gap-2">
                                                            {{ file.file_type }}
                                                        </span>
                                                    </div>
                                                    <div class="inline-flex self-center items-center">
                                                        <button
                                                            class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
                                                            type="button" @click="removeFile(index)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                                                <line x1="9" y1="9" x2="15" y2="15"></line>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--  -->
                                        </div>
                                        
                                    </div>
                                </div>

                                <button type="submit" @click="saveTask()"
                                    class="text-white inline-flex items-center bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    components: {
        AuthenticatedLayout, Head
    },
    props: {
        task: Object,
        errors: Object,
    },
    setup(props) {
        const form = useForm(props.task)
        return { form }
    },
    data() {
        return {

        };
    },

    methods: {
        // showTooltip() {
        //     this.isTooltipVisible = true; // Mostrar el tooltip
        // },
        // hideTooltip() {
        //     this.isTooltipVisible = false; // Ocultar el tooltip
        // },
        // decodeHtml(html) {
        //     const txt = document.createElement('textarea');
        //     txt.innerHTML = html;
        //     return txt.value;
        // },
        // editTask() {
        //     // Lógica para la acción de editar
        //     console.log("Editar acción activada");
        // },
        // deleteTask(selectedTask) {
        //     this.TaskDelete = selectedTask;
        //     this.showModal = true;
        // },
        // confirmDelete() {
        //     this.showModal = false;
        //     let idTask = Number(this.TaskDelete.id);
        //     router.delete(route('task.destroy', idTask), {
        //         forceFormData: true,
        //     })
        // },
        // toggleTaskCompletion(selectedTask) {
        //     console.log(selectedTask.id);
        // },

        // handleFiles(event) {
        //     const newFiles = Array.from(event.target.files);
        //     this.addFiles(newFiles);
        // },
        // handleDrop(event) {
        //     const newFiles = Array.from(event.dataTransfer.files);
        //     this.addFiles(newFiles);
        // },
        // addFiles(newFiles) {
        //     const filteredFiles = newFiles.filter((file) => {
        //         const isValidType = file.type === "application/pdf" || file.type.startsWith("image/jpeg");
        //         const isNotDuplicate = !this.form.files.find((f) => f.name === file.name && f.size === file.size);
        //         return isValidType && isNotDuplicate;
        //     });

        //     if (this.form.files.length + filteredFiles.length > 10) {
        //         alert("No puedes subir más de 10 archivos.");
        //         return;
        //     }
        //     this.form.files.push(...filteredFiles);
        // },
        // removeFile(index) {
        //     this.form.files.splice(index, 1);
        // },
        // saveTask() {
        //     console.log(this.form);
        //     router.post('/task', this.form, {
        //         onBefore: (visit) => { },
        //         onStart: (visit) => { },
        //         onProgress: (progress) => {

        //         },
        //         onSuccess: (page) => { },
        //         onError: (errors) => { },
        //         onCancel: () => { },
        //         onFinish: visit => { },
        //         onPrefetching: () => { },
        //         onPrefetched: () => { },
        //     })
        // },
    },
};
</script>
