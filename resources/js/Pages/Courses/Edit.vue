<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Modification de {{ courseData.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-green-200 text-green-500 p-3" v-if="$page.flash.success">
                    {{ $page.flash.success }}
                </div>
                <div class="w-full">
                  <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="submit">
                    <div class="mb-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Titre de la formation
                      </label>
                      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" v-model="courseData.title">
                      <div class="bg-red-200 text-red-800 p-4 my-2" v-if="$page.errors.title">{{ $page.errors.title[0] }}</div>
                    </div>

                    <div class="mb-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description de la formation
                      </label>
                      <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" type="text" v-model="courseData.description"></textarea>
                      <div class="bg-red-200 text-red-800 p-4 my-2" v-if="$page.errors.description">{{ $page.errors.description[0] }}</div>
                    </div>
                    <div class="mb-4">
                        <h2 class="text-2xl">Episodes de la formation</h2>
                        <div v-for="(chapter, index) in courseData.chapters" v-bind:key="index">

                            <label class="block text-gray-700 text-sm font-bold mb-2" :for="'title-' + index">
                            Titre du chapitre n° {{ index + 1 }}
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :id="'title-' + index" type="text" v-model="courseData.chapters[index].title">

                            <div class="bg-red-200 text-red-800 p-4 my-2" v-if="$page.errors['chapters.' + index + '.title']">{{ $page.errors['chapters.' + index + '.title'][0] }}</div>

                            <label class="block text-gray-700 text-sm font-bold mb-2" :for="'description-' + index">
                            Description du chapitre n° {{ index + 1 }}
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :id="'description-' + index" type="text" v-model="courseData.chapters[index].description">

                            <div class="bg-red-200 text-red-800 p-4 my-2" v-if="$page.errors['chapters.' + index + '.description']">{{ $page.errors['chapters.' + index + '.description'][0] }}</div>

                            <label class="block text-gray-700 text-sm font-bold mb-2" :for="'title-' + video_url">
                            URL de la vidéo du chapitre n° {{ index + 1 }}
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-10 leading-tight focus:outline-none focus:shadow-outline" :id="'title-' + video_url" type="text" v-model="courseData.chapters[index].video_url">

                            <div class="bg-red-200 text-red-800 p-4 my-2" v-if="$page.errors['chapters.' + index + 'video_url']">{{ $page.errors['chapters.' + index + 'video_url'][0] }}</div>

                        </div>
                    </div>
                    <button class="py-2 px-4 bg-green-600 rounded my-2 text-white block" @click.prevent="add" v-if="courseData.chapters.length < 15">+</button>
                    <button class="py-2 px-4 bg-red-600 rounded my-2 text-white block" @click.prevent="remove" v-if="courseData.chapters.length > 1">🗑️</button>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Modifier ma formation</button>
                  </form>
                </div>
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

        props: ['course'],

        data() {
            return {
                courseData: this.course
            }
        },

        methods: {
            submit() {
                this.$inertia.patch('/courses/' + this.courseData.id, this.courseData)
            },

            add() {
                this.courseData.chapters.push({title: null, description: null, video_url: null})
            },
            remove() {
                this.courseData.chapters.pop()
            }
        }
    }
</script>
