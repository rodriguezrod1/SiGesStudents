<template>
    <div class="container mt-5">
        
        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default border-bottom">
                        <h3 class="block-title">Student Management</h3>
                        <div class="block-options">
                            <inertia-link href="/students/create" class="btn btn-primary btn-block">
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
                                                <th>Last name</th>
                                                <th>Age</th>
                                                <th>Email</th>
                                                <th>Associated courses</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="student in students" :key="student.id">
                                                <td>{{ student.name }}</td>
                                                <td>{{ student.last_name }}</td>
                                                <td>{{ student.age }}</td>
                                                <td>{{ student.email }}</td>
                                                <td>
                                                    <ul>
                                                        <li v-for="course in student.courses" :key="course.id">
                                                            {{ course.name }} ({{ course.start_date }} - {{ course.end_date
                                                            }})
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="text-center d-flex">
                                                    <inertia-link :href="`/students/${student.id}`"
                                                        class="btn btn-sm btn-primary me-2">
                                                        <i class="fas fa-eye"></i> 
                                                    </inertia-link>
                                                    <inertia-link :href="`/students/${student.id}/edit`"
                                                        class="btn btn-sm btn-warning me-2">
                                                        <i class="fas fa-edit"></i> 
                                                    </inertia-link>
                                                    <button @click.prevent="deleteStudents(`${student.id}`)"
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
        students: Array
    },
    setup() {
        function deleteStudents(id) {
            if (confirm('Are you sure@?'))
                Inertia.delete(`/students/${id}`)
        }
        return {
            deleteStudents
        }
    }
}
</script>