
<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default border-bottom">
                        <h3 class="block-title">Edit Course</h3>
                        <div class="block-options">
                            <inertia-link href="/" class="btn btn-secondary btn-md shadow-sm">Go back
                            </inertia-link>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-12">
                                <course-form :errors="errors" :course="course" />
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
import CourseForm from '../components/CourseForm.vue'

export default {
    components: { CourseForm },
    layout: LayoutApp,
    props: {
        errors: {
            type: Object
        },
        course: {
            type: Array
        }
    }
}
</script>