
<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default border-bottom">
                        <h3 class="block-title">Detalles de Curso</h3>
                        <div class="block-options">
                            <inertia-link href="/courses" class="btn btn-secondary btn-md shadow-sm">Go Back
                            </inertia-link>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <tr>
                                        <th>NAME</th>
                                        <td>{{ course.name }}</td>
                                    </tr>
                                    <tr>
                                        <th>SCHEDULE</th>
                                        <td>{{ course.schedule }}</td>
                                    </tr>
                                    <tr>
                                        <th>START DATE</th>
                                        <td>{{ course.start_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>END DATE</th>
                                        <td>{{ course.end_date }}</td>
                                    </tr>
                                    <tr>
                                        <th># STUDENTS</th>
                                        <td>{{ students }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import LayoutApp from '../../Layouts/App.vue'
import { reactive } from 'vue'

export default {
    layout: LayoutApp,
    props: {
        course: {
            type: Object
        },
        students: {
            type: Number
        },
    },
    setup(props) {

        const course = reactive({
            name: props.course.name,
            schedule: props.course.schedule,
            start_date: props.course.start_date,
            end_date: props.course.end_date,
            students: props.students,
        })

        return {
            course
        }
    }
}
</script>