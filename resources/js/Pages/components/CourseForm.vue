<template>
    <form @submit.prevent="handlerSubmit">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group ">
                    <div class="form-floating ">
                        <input autofocus type="text" placeholder="name" name="name" id="name" v-model="course.name"
                            class="form-control">
                        <label class="form-label" for="name">Name</label>
                    </div>
                    <div v-if="errors.name">
                        <p class="text-danger">{{ errors.name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group ">
                    <div class="form-floating ">
                        <input type="text" placeholder="schedule" name="schedule" id="schedule" v-model="course.schedule"
                            class="form-control">
                        <label class="form-label" for="schedule">Schedule</label>
                    </div>
                    <div v-if="errors.schedule">
                        <p class="text-danger">{{ errors.schedule }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group ">
                    <div class="form-floating ">
                        <input type="date" placeholder="start_date" name="start_date" id="start_date"
                            v-model="course.start_date" class="form-control">
                        <label class="form-label" for="start_date">Start date</label>
                    </div>
                    <div v-if="errors.start_date">
                        <p class="text-danger">{{ errors.start_date }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group ">
                    <div class="form-floating ">
                        <input type="date" placeholder="end_date" name="end_date" id="end_date" v-model="course.end_date"
                            class="form-control">
                        <label class="form-label" for="end_date">End date</label>
                    </div>
                    <div v-if="errors.end_date">
                        <p class="text-danger">{{ errors.end_date }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4 justify-content-end">
            <div class="col-md-2">
                <inertia-link href="/" class="btn btn-secondary btn-md shadow-sm">Go back
                </inertia-link>
            </div>
            <div class="col-md-3">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-lg btn-primary ">
                        Process
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>
<script>

import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {
    props: {
        errors: {
            type: Object,
            default: null
        },
        course: {
            type: Object,
            required: true,
            default: () => ({
                name: '',
                schedule: '',
                start_date: '',
                end_date: '',
            })
        },
    },

    setup(props) {

        const course = reactive({
            name: !props.course?.id ? '' : props.course.name,
            schedule: !props.course?.id ? '' : props.course.schedule,
            start_date: !props.course?.id ? '' : props.course.start_date,
            end_date: !props.course?.id ? '' : props.course.end_date,
        })

        function handlerSubmit() {

            const { name, schedule, start_date, end_date } = course

            const method = props.course.id ? 'put' : 'post'
            const url = props.course.id ? `/courses/${props.course.id}` : '/courses'

            Inertia[method](url, {
                name,
                schedule,
                start_date,
                end_date
            })
        }

        return {
            course,
            handlerSubmit
        }
    }
}
</script>