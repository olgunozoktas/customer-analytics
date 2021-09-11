<template>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-4 mx-auto bg-white flex flex-col">
            <div class="flex flex-col lg:flex-row justify-start gap-2">
                <button @click="loadDayHistory()"
                        :class="selectedDay === null ? 'bg-primary text-white' : 'bg-primary-button hover:bg-primary hover:text-white'"
                        class="flex flex-row gap-2 items-center py-2 px-8 text-black transition duration-150 ease-in-out font-bold rounded-full mb-4 font-sans">
                    Bugünkü Sonuçlar
                </button>
                <button @click="loadDayHistory(1)"
                        :class="selectedDay === 1 ? 'bg-primary text-white' : 'bg-primary-button hover:bg-primary hover:text-white'"
                        class="flex flex-row gap-2 items-center py-2 px-8 text-black transition duration-150 ease-in-out font-bold rounded-full mb-4 font-sans">
                    1 Gün Önceki Sonuçlar
                </button>
                <button @click="loadDayHistory(2)"
                        :class="selectedDay === 2 ? 'bg-primary text-white' : 'bg-primary-button hover:bg-primary hover:text-white'"
                        class="flex flex-row gap-2 items-center py-2 px-8 text-black transition duration-150 ease-in-out font-bold rounded-full mb-4 font-sans">
                    2 Gün Önceki Sonuçlar
                </button>
                <button @click="loadDayHistory(3)"
                        :class="selectedDay === 3 ? 'bg-primary text-white' : 'bg-primary-button hover:bg-primary hover:text-white'"
                        class="flex flex-row gap-2 items-center py-2 px-8 text-black transition duration-150 ease-in-out font-bold rounded-full mb-4 font-sans">
                    3 Gün Önceki Sonuçlar
                </button>
            </div>
            <div class="flex flex-row justify-center items-center border-t border-gray-200 pt-4" v-if="loading">
                Yükleniyor...
            </div>
            <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 border-t border-gray-200 pt-4" v-if="!loading">
                <div class="flex flex-col shadow gap-2 px-4 py-2" v-for="hour in weatherData.hourly">
                    <div class="flex items-center justify-center">
                        <img :src="'https://openweathermap.org/img/w/' + hour.weather[0].icon + '.png'" alt=""
                             class="w-25 h-25">
                    </div>
                    <div class="flex flex-row gap-2">
                        <span class="text-black font-bold border-b border-gray-900">Tarih Saat: {{
                                hour.full_time
                            }}</span>
                    </div>
                    <div class="flex flex-row gap-2">
                        <span class="text-black font-bold">Hava Durumu: {{ hour.weather[0].description }}</span>
                    </div>
                    <div class="flex flex-row gap-2">
                        <span>Sıcaklık: {{ hour.temp }}&#8457;</span>
                        <span class="pl-4">Hissedilen Sıcaklık: {{ hour.feels_like }}&#8457;</span>
                    </div>
                    <div class="flex flex-row gap-2">
                        <span>Rüzgar Hızı: {{ hour.wind_speed }} m/s</span>
                        <span class="pl-4">Nem oranı: {{ hour.humidity }}%</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

export default {
    props: [''],
    data() {
        return {
            selectedDay: null,
            weatherData: [],
            loading: false,
        }
    },

    methods: {
        loadDayHistory(day = null) {
            let url = window.baseUrl + 'weather-history';
            url += day != null ? '/' + day : '';
            this.selectedDay = day;

            this.loading = true;
            axios.get(url).then(res => {
                this.weatherData = res.data;
                this.loading = false;
            }).catch(e => console.log(e.message))
        },
    },
    mounted() {
        this.loadDayHistory();
    }
}
</script>
