<template>

    <div>
        <div class="card">

            <div class="card-header">
                {{ checkup.name }}

                <div class="float-right">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#store">
                        Edit
                    </button>
                </div>
            </div>
            <div class="card-body">
                <p>Checkup name: {{ checkup.name }}</p>
                <p>Checkup description: {{ checkup.description || "N/A" }}</p>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Form - {{ checkup.name }} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" v-model="checkup.name">
                        </div>

                        <div class="form-group">
                            <label for="description">Email</label>
                            <textarea id="description" name="description" class="form-control"  v-model="checkup.description">

                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="patch" >Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import {mapActions, mapGetters} from "vuex";
    import swal from "sweetalert";

    export default {
        name: "Checkup",
        computed: {
            ...mapGetters("checkups", [
                "checkup"
            ])
        },
        methods: {
            ...mapActions("checkups", [
                "get",
                "update"
            ]),
            patch() {

                swal({
                    title: 'Are you sure to update ?',
                    buttons: true,
                    dangerMode: true
                }).then((response) => {

                    if (response) {
                        this.update({
                            id: this.checkup.id,
                            data: this.checkup
                        }).then(() => {
                            $("#edit").modal('hide');
                        }).catch(function (e) {
                            console.log(e)
                        });
                    }

                }).catch(() => {
                    swal.stopLoading();
                });

            }
        },
        created() {
            this.get(this.$route.params.id);
        }
    }
</script>

<style scoped>

</style>
