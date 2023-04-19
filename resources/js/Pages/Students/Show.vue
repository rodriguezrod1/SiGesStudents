
<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default border-bottom">
                        <h3 class="block-title">Student Details</h3>
                        <div class="block-options">
                            <inertia-link href="/students" class="btn btn-secondary btn-md shadow-sm">Go Back
                            </inertia-link>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <tr>
                                        <th>NAME</th>
                                        <td>{{ student.name }}</td>
                                    </tr>
                                    <tr>
                                        <th>LAST NAME</th>
                                        <td>{{ student.last_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>AGE</th>
                                        <td>{{ student.age }}</td>
                                    </tr>
                                    <tr>
                                        <th>EMAIL</th>
                                        <td>{{ student.email }}</td>
                                    </tr>
                                    <tr>
                                        <th>ASSOCIATED COURSES</th>
                                        <td>
                                            <ul>
                                                <li v-for="course in student.courses" :key="course.id">
                                                    {{ course.name }} ({{ course.start_date }} - {{ course.end_date
                                                    }})
                                                </li>
                                            </ul>
                                        </td>
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
        student: {
            type: Object
        },
    },
    setup(props) {

        const student = reactive({
            name: props.student.name,
            last_name: props.student.last_name,
            age: props.student.age,
            email: props.student.email,
            courses: props.student.courses
        })

        return {
            student
        }
    }
}
</script>