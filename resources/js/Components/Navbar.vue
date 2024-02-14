<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <Link class="nav-link" :href="route('students.create')">
                            Enroll Student
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link  class="nav-link" :href="route('teachers.create')">
                            Add Teacher
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link  class="nav-link" :href="route('careers.create')">
                            Add Career
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link  class="nav-link" :href="route('subjects.create')">
                            Add Subject
                        </Link>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><Link class="dropdown-item" :href="route('students.index')">Students</Link></li>
                            <li><Link class="dropdown-item" :href="route('teachers.index')">Teachers</Link></li>
                            <li><Link class="dropdown-item" :href="route('careers.index')">Careers</Link></li>
                            <li><Link class="dropdown-item" :href="route('subjects.index')">Subjects</Link></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/vue3';
export default {
    components: {
        Link
    }
}
</script>

<style scoped>

</style>
