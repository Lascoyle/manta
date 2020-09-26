<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
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
                      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" v-model="form.title">
                      <div class="bg-red-200 text-red-800 p-4" v-if="$page.errors.title">{{ $page.errors.title[0] }}</div>
                    </div>

                    <div class="mb-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description de la formation
                      </label>
                      <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" type="text" v-model="form.description"></textarea>
                      <div class="bg-red-200 text-red-800 p-4" v-if="$page.errors.description">{{ $page.errors.description[0] }}</div>
                    </div>
                    <div class="mb-4">
                        <h2 class="text-2xl">Episodes de la formation</h2>
                        <div v-for="(chapter, index) in form.chapters" v-bind:key="index">

                            <label class="block text-gray-700 text-sm font-bold mb-2" :for="'title-' + index">
                            Titre du chapitre n° {{ index + 1 }}
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :id="'title-' + index" type="text" v-model="form.chapters[index].title">

                            <label class="block text-gray-700 text-sm font-bold mb-2" :for="'description-' + index">
                            Description du chapitre n° {{ index + 1 }}
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :id="'description-' + index" type="text" v-model="form.chapters[index].description">

                            <label class="block text-gray-700 text-sm font-bold mb-2" :for="'title-' + video_url">
                            URL de la vidéo du chapitre n° {{ index + 1 }}
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-10 leading-tight focus:outline-none focus:shadow-outline" :id="'title-' + video_url" type="text" v-model="form.chapters[index].video_url">

                        </div>
                    </div>
                    <button class="py-2 px-4 bg-green-600 rounded my-2 text-white block" @click.prevent="add" v-if="form.chapters.length < 15">+</button>
                    <button class="py-2 px-4 bg-red-600 rounded my-2 text-white block" @click.prevent="remove" v-if="form.chapters.length > 1">🗑️</button>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Créer ma formation</button>
                  </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'

    export default {
        components: {
            AppLayout
        },

        data() {
            return {
                form: {
                    title: null,
                    description: null,
                    chapters: [
                        {
                            title:null,
                            description: null,
                            video_url: null
                        }
                    ]
                }
            }
        },

        methods: {
            submit() {
                this.$inertia.post('/courses', this.form)
            },

            add() {
                this.form.chapters.push({title: null, description: null, video_url: null})
            },
            remove() {
                this.form.chapters.pop()
            }
        }
    }
</script>
