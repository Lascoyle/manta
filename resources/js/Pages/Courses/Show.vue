<template>
    <app-layout>
        <template slot='header'>
            {{ course.title }}
        </template>
        <div class="py-6 mx-16">
            <p class="text-2xl">{{ this.courseShow.chapters[this.currentKey].title }}</p>
            <iframe class="w-full h-screen py-6 px-20" :src="this.courseShow.chapters[this.currentKey].video_url" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <p class="text-sm text-gray-500">{{ this.courseShow.chapters[this.currentKey].description }}</p>

            <div class="mt-6">
                <ul v-for="(chapter, index) in this.courseShow.chapters" v-bind:key="chapter.id">
                    <li class="mt-3 flex justify-between items-center">
                        <div>
                            Chapitre n°{{ index + 1 }} - {{ chapter.title }}
                            <button class="text-gray-500 text-sm focus:text-indigo-500 focus:outline-none mx-2" @click="switchChapter(index)">Voir le chapitre</button>
                        </div>
                        <progress-button :chapter-id="chapter.id" :watched-chapters="watched"></progress-button>
                    </li>
                </ul>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from './../../Layouts/AppLayout'
import ProgressButton from './ProgressButton'

export default {
    components: {
        AppLayout,
        ProgressButton
    },

    props : ['course', 'watched'],

    data() {
        return {
            courseShow: this.course,
            currentKey: 0
        }
    },

    methods: {
        switchChapter(index) {
            this.currentKey = index;
            window.scrollTo({
                top: 200,
                left: 0,
                behavior: 'smooth'
            });
        }
    },

    mounted() {
        // console.log(this.coursesList);
    }
}
</script>