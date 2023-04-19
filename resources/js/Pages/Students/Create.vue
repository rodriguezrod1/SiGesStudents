
<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default border-bottom">
                        <h3 class="block-title">New Student</h3>
                        <div class="block-options">
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-12">
                                <student-form :errors="errors" :courses="courses" />
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
import StudentForm from '../components/StudentForm.vue'

export default {
    components: { StudentForm },
    layout: LayoutApp,
    props: {
        errors: {
            type: Object
        },
        courses: {
            type: Array
        },
    }
}
</script>
 