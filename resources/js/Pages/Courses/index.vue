<template>
    <app-layout>
        <template slot='header'>
            Liste des formations
        </template>
        <div class="py-6" v-for="course in this.coursesList.data" v-bind:key="course.id">
            <div class="mx-8 bg-white rounded-lg shadow p-6">
                <p class="text-sm text-gray-500 mb-3">Mis en ligne par {{ course.user.name }}</p>
                <div class="mb-3 flex justify-between items-baseline">
                    <h1 class="text-2xl">{{ course.title }}</h1>
                    <p class="text-sm text-gray-400">{{ course.chapters_count }} Chapitres</p>
                </div>
                <p class="text-sm text-gray-500">{{ course.description }}</p>
                <div class="flex items-center justify-between">
                    <a :href="'course/' + course.id" class="bg-indigo-600 rounded-md inline-block p-2 text-white text-sm mt-3 hover:bg-indigo-800">Voir la formation</a>
                    <a :href="'courses/edit/' + course.id" v-if="course.update" class="bg-gray-600 rounded-md inline-block p-2 text-white text-sm mt-3 hover:bg-gray-800">Editer la formation</a>
                </div>
            </div>
        </div>
        <div class="pagination text-center">
            <inertia-link v-bind:href="link.url" v-for="link in courses.links" v-bind:key="link.label" class="p-3 text-gray-600">
                <span v-bind:class="{ 'text-indigo-600 border-indigo-600 border-b-2 bold' : link.active, 'text-gray-400' : link.url===null }">{{ link.label }}</span>
            </inertia-link>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from './../../Layouts/AppLayout'

export default {
    components: {
        AppLayout
    },

    props : ['courses'],

    data() {
        return {
            coursesList : this.courses
        }
    },


    mounted() {
        console.log(this.coursesList);
    }
}
</script>