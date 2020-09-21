<template>
    <app-layout>
        <template slot='header'>
            Liste des formations
        </template>
        <div v-for="course in this.coursesList" v-bind:key="course.id">
            <div>{{ course.title }}</div>
            <div>{{ course.description }}</div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from './../../Layouts/AppLayout'

export default {
    components: {
        AppLayout
    },

    data() {
        return {
            coursesList : this.courses
        }
    },

    props : ['courses'],

    mounted() {
        console.log(this.coursesList);
    }
}
</script>