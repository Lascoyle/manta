<template>
    <div>
        <div class="bg-gray-200 w-full rounded">
            <div class="bg-green-500 text-white rounded-l text-center transition-width duration-500" :style="'width:' + percentage + '%'"> {{ percentage }}%</div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'watchedChapters',
        'chapters'
    ],

    data() {
        return {
            watchedChaptersData: this.watchedChapters
        }
    },

    computed: {
        percentage() {
            let filteredChap = this.chapters.filter(courseChap => {
                return this.watchedChaptersData.find(watchedChap => {
                    return watchedChap.id === courseChap.id;
                });
            });

            return Math.round(filteredChap.length / this.chapters.length * 100);
        }
    },

    mounted() {
        eventBus.$on('toggleProgress', data => this.watchedChaptersData = data);
    }
}
</script>
