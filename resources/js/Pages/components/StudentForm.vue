<template>
    <form @submit.prevent="handlerSubmit">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group ">
                    <div class="form-floating ">
                        <input autofocus type="text" placeholder="name" id="name" v-model="student.name"
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
                        <input type="text" placeholder="last_name" id="last_name" v-model="student.last_name"
                            class="form-control">
                        <label class="form-label" for="last_name">Last Name</label>
                    </div>
                    <div v-if="errors.last_name">
                        <p class="text-danger">{{ errors.last_name }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-2">
                <div class="form-group ">
                    <div class="form-floating ">
                        <input type="number" placeholder="age" id="age" v-model="student.age" class="form-control">
                        <label class="form-label" for="age">Age</label>
                    </div>
                    <div v-if="errors.age">
                        <p class="text-danger">{{ errors.age }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group ">
                    <div class="form-floating ">
                        <input type="email" placeholder="email" id="email" v-model="student.email" class="form-control">
                        <label class="form-label" for="email">Email</label>
                    </div>
                    <div v-if="errors.email">
                        <p class="text-danger">{{ errors.email }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group ">
                    <div class="form-floating ">
                        <select multiple id="courses" v-model="student.courses" class="form-control">
                            <option v-for="course in courses" :key="course.id" :value="course.id">{{ course.name }}</option>
                        </select>
                        <label class="form-label" for="courses">Courses</label>
                    </div>
                    <div v-if="errors.courses">
                        <p class="text-danger">{{ errors.courses }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4 justify-content-end">
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
        courses: {
            type: Array,
            default: () => []
        },
        student: {
            type: Object,
            required: true,
            default: () => ({
                name: '',
                last_name: '',
                age: '',
                email: '',
                courses: []
            })
        },
    },

    setup(props) {

        const student = reactive({
            name: !props.student?.id ? '' : props.student.name,
            last_name: !props.student?.id ? '' : props.student.last_name,
            age: !props.student?.id ? '' : props.student.age,
            email: !props.student?.id ? '' : props.student.email,
            courses: !props.student?.id ? '' : props.student.courses
        })

        function handlerSubmit() {

            const { name, last_name, age, email, courses } = student

            const method = props.student.id ? 'put' : 'post'
            const url = props.student.id ? `/students/${props.student.id}` : '/students'

            Inertia[method](url, {
                name,
                last_name,
                age,
                email,
                courses
            })
        }

        return {
            student,
            handlerSubmit
        }
    }
}
</script>