<template>
    <div>
        <div v-if="isCurrentlyLogging">
            <span class="stopwatch">{{ stopwatch }}</span>
        </div>
        <div v-if="!isCurrentlyLogging">
            <a href="#" @click.prevent="logTime()" class="button button--block button--solid-primary">
                Log Time
            </a>
        </div>
        <div v-else>
            <a href="#" @click.prevent="stopTime()" class="button button--block button--solid-secondary">
                Stop Logging Time
            </a>
        </div>
    </div>
</template>

<style>
    .stopwatch {
        font-size: 7rem;
        text-align: center;
        margin: 0 auto;
        width: 100%;
        display: block;
    }
</style>

<script>
    export default {
        props: ['project'],
        data() {
            return {
                isCurrentlyLogging: false,
                totalSeconds: 0,
                start: 0,
                delta: 0,
                stopwatch: '00:00:00',
                timer: 0
            }
        },
        methods: {
            logTime() {
                this.isCurrentlyLogging = true
                this.start = Date.now()
                this.incrementTimeElapsed()
            },
            stopTime() {
                clearInterval(this.timer)
                axios.post('/api/logtime/'+this.project.id, {
                    'number_of_seconds': this.totalSeconds
                }).then(({data}) => {
                    // reset
                    this.isCurrentlyLogging = false
                    this.totalSeconds = 0
                    this.stopwatch = '00:00:00'
                })
            },
            incrementTimeElapsed() {
                this.timer = setInterval(() => {
                    this.delta = Date.now() - this.start
                    this.stopwatch = this.formatTime(this.secondsToTime((this.delta)/1000))
                    this.totalSeconds = Math.floor(this.delta / 1000)
                }, 1000)
            },
            // Stolen from stackoverflow
            formatTime(dateObject) {
                let time = []
                time.push(dateObject.h)
                time.push(dateObject.m)
                time.push(dateObject.s)
                return time.join(':')
            },
            secondsToTime(secs) {
                let hours = Math.floor(secs / (60 * 60))
                let minutes = Math.floor(secs / 60)
                let seconds = Math.floor(secs % 60)
                let obj = {
                    "h": hours.toString().length === 1 ? '0' + hours : hours,
                    "m": minutes.toString().length === 1 ? '0' + minutes : minutes,
                    "s": seconds.toString().length === 1 ? '0' + seconds : seconds
                }
                return obj
            }
        }
    }
</script>
