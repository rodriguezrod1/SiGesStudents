
<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default border-bottom">
                        <h3 class="block-title">Course Management</h3>
                        <div class="block-options">
                            <inertia-link href="/courses/create" class="btn btn-primary btn-block">
                                <i class="fa fa-plus-circle"></i>&nbsp;
                                New 
                            </inertia-link>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="table_id"
                                        class="table text-center table-bordered table-hover table-striped table-condensed ">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Schedule</th>
                                                <th>Start date</th>
                                                <th>End date</th>
                                                <th># Students</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="course in courses" :key="course.id">
                                                <td>{{ course.name }}</td>
                                                <td>{{ course.schedule }}</td>
                                                <td>{{ course.start_date }}</td>
                                                <td>{{ course.end_date }}</td>
                                                <td>{{ course.students_count }}</td>
                                                <td class="text-center d-flex">
                                                    <inertia-link :href="`/courses/${course.id}`"
                                                        class="btn btn-sm btn-primary me-2">
                                                        <i class="fas fa-eye"></i> 
                                                     </inertia-link>
                                                    <inertia-link :href="`/courses/${course.id}/edit`"
                                                        class="btn btn-sm btn-warning me-2">
                                                        <i class="fas fa-edit"></i> 
                                                     </inertia-link>
                                                    <button @click.prevent="deleteCourse(`${course.id}`)"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-times"></i> 
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'

export default {
    layout: LayoutApp,
    components: {
        Link
    },
    props: {
        courses: Array
    },
    setup() {
        function deleteCourse(id) {
            if (confirm('Are you sure@?'))
                Inertia.delete(`/courses/${id}`)
        }
        return {
            deleteCourse
        }
    }
}
</script>