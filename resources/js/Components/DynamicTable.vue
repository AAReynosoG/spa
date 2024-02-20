<template>
    <div class="table-responsive">
        <table class="table table-striped custom-table">
            <thead>
                <tr>
                    <th scope="col" v-for="thead in theaders" :key="thead">{{ thead }}</th>
                    <th v-if="addButtons" colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in arr" :key="item.id">
                    <td v-for="value in item" :key="value" v-if="value!=id">{{ value }}</td>
                    <td v-if="addButtons">
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        arr: Array,
        theaders: Array,
        addButtons: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        columns() {
            return this.theaders.length;
        }
    },
    methods: {
        /*destroy(id) {
            if (confirm("Are you sure?")) {
                //this.$inertia.delete(route('users.destroy', {id: id}));
            }
        }*/
    }
}
</script>

<style scoped>

</style>
#
