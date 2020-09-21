<template>
    <app-layout>
        <template slot='header'>
            Liste des formations
        </template>
        <div class="py-6" v-for="course in this.coursesList" v-bind:key="course.id">
            <div class="mx-8 bg-white rounded-lg shadow p-6">
                <p class="text-sm text-gray-500 mb-3">Mis en ligne par {{ course.user.name }}</p>
                <div class="mb-3 flex justify-between items-baseline">
                    <h1 class="text-2xl">{{ course.title }}</h1>
                    <p class="text-sm text-gray-400">{{ course.chapters_count }} Chapitres</p>
                </div>
                <p class="text-sm text-gray-500">{{ course.description }}</p>
                <a :href="'course/' + course.id" class="bg-indigo-600 rounded-md inline-block p-2 text-white text-sm mt-3 hover:bg-indigo-800">Voir la formation</a>
            </div>
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