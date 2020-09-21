<template>
    <div>
        <button class="bg-green-500 rounded-md text-white p-1 text-sm" @click="toggleProgress()">
            {{ this.isWatched ? 'Terminé' : 'Terminé?'}}
        </button>
    </div>
</template>

<script>
export default {
    props: ['chapterId', 'watchedChapters'],

    data() {
        return {
            watchedChap: this.watchedChapters,
            isWatched: null
        }
    },

    methods: {
        toggleProgress() {
            axios.post('/toggleProgress', {
                chapterId: this.chapterId,
            })
            .then(response => {
                if (response.status === 200) {
                    this.isWatched = !this.isWatched;
                }
            })
            .catch(error => console.log(error));
        },
        isWatchedChapter() {
            return this.watchedChap.find(chapter => chapter.id === this.chapterId) ? true : false;
        }
    },

    mounted() {
        this.isWatched = this.isWatchedChapter();
    }
}
</script>