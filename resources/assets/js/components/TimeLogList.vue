<template>
    <div>
        <h1 v-if="!this.minimal">
            <i class="fas fa-user-clock"></i> Time Logs 
            <small>
                <a @click="openTimeLogsWindow()">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </small>
        </h1>
        <stopwatch :project="this.project" @time-log-updated="timeLogUpdated"></stopwatch>
        <div v-if="this.timelogs.length > 0">
            <ul class="list-group">
            <div v-for="timelog in this.timelogs">
                <li class="list-group__item">
                    <i class="fas fa-clock"></i>
                    {{timelog.number_of_seconds_for_humans }} on {{timelog.created_at | moment("dddd, MMMM Do YYYY, h:mm:ss a")}}
                </li>
            </div>
            </ul>
        </div>
        <div v-else>
            <p>No time logs have been created. Click the "Log Time" button above to get started.</p>
        </div>
    </div>
</template>

<script>
    import Stopwatch from './Stopwatch'
    export default {
        props: ['project', 'minimal'],
        components: {Stopwatch},
        mounted() {
            this.timelogs = this.project.timelogs
        },
        data() {
            return {
                timelogs: []
            }
        },
        methods: {
            openTimeLogsWindow() {
                window.open("/projects/"+this.project.slug+"/timelog", "mytrackr timer", "location=0,status=0,scrollbars=1,width=800,height=600");
            },
            timeLogUpdated(timelog) {
                this.timelogs.unshift(timelog)
            }
        }
    }
</script>
