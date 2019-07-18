<style scoped>
    .action-link {
        cursor: pointer;
    }
</style>

<template>
    <div>
        <div class="card card-default">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span>
                        Users
                    </span>

                    <a class="action-link" tabindex="-1" @click="showCreateClientForm">
                        Create New User
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Current Clients -->
                <p class="mb-0" v-if="clients.length === 0">
                    No user data to display at the moment.
                </p>

                <table class="table table-borderless mb-0" v-if="clients.length > 0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Post Code</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="client in clients">
                        <!-- ID -->
                        <td style="vertical-align: middle;">
                            {{ client.id }}
                        </td>

                        <!-- Name -->
                        <td style="vertical-align: middle;">
                            {{ client.name }}
                        </td>

                        <!-- Secret -->
                        <td style="vertical-align: middle;">
                            <code>{{ client.secret }}</code>
                        </td>

                        <!-- Edit Button -->
                        <td style="vertical-align: middle;">
                            <a class="action-link" tabindex="-1" @click="edit(client)">
                                Edit
                            </a>
                        </td>

                        <!-- Delete Button -->
                        <td style="vertical-align: middle;">
                            <a class="action-link text-danger" @click="destroy(client)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create Client Modal -->
        <div class="modal fade" id="modal-create-client" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Create User
                        </h4>

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="createForm.errors.length > 0">
                            <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in createForm.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Create User Form -->
                        <form role="form">
                            <!-- First Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">First Name</label>

                                <div class="col-md-9">
                                    <input id="create-user-first-name" type="text" class="form-control"
                                           name="first_name"
                                           @keyup.enter="store" v-model="createForm.first_name">

                                </div>
                            </div>
                            <!-- Last Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Last Name</label>

                                <div class="col-md-9">
                                    <input id="create-user-last-name" type="text" class="form-control"
                                           name="last_name"
                                           @keyup.enter="store" v-model="createForm.last_name">

                                </div>
                            </div>

                            <!-- Address -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Address</label>

                                <div class="col-md-9">
                                    <input id="create-user-address" type="text" class="form-control"
                                           name="address"
                                           @keyup.enter="store" v-model="createForm.address">

                                </div>
                            </div>

                            <!-- Post Code -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Post Code</label>

                                <div class="col-md-9">
                                    <input id="create-user-post-code" type="text" class="form-control"
                                           name="post_code"
                                           @keyup.enter="store" v-model="createForm.post_code">

                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Phone Number</label>

                                <div class="col-md-9">
                                    <input type="text" id="create-user-phone-number" class="form-control"
                                           name="phone-number"
                                           @keyup.enter="store" v-model="createForm.phone_number">

                                </div>
                            </div>

                            <!-- Email -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Email</label>

                                <div class="col-md-9">
                                    <input type="text" id="create-user-email" class="form-control"
                                           name="email"
                                           @keyup.enter="store" v-model="createForm.email">

                                </div>
                            </div>
                            <!-- Username -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Username</label>

                                <div class="col-md-9">
                                    <input type="text" id="create-user-username" class="form-control"
                                           name="username"
                                           @keyup.enter="store" v-model="createForm.username">

                                </div>
                            </div>
                            <!-- Password -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Password</label>

                                <div class="col-md-9">
                                    <input type="text" id="create-user-password" class="form-control"
                                           name="password"
                                           @keyup.enter="store" v-model="createForm.password">

                                </div>
                            </div>
                            <!-- Password -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Password Confirm</label>

                                <div class="col-md-9">
                                    <input type="text" id="create-user-password-confirm" class="form-control"
                                           name="password_confirmation"
                                           @keyup.enter="store" v-model="createForm.password_confirm">

                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="store">
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Client Modal -->
        <div class="modal fade" id="modal-edit-client" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Edit Client
                        </h4>

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="editForm.errors.length > 0">
                            <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in editForm.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Edit Client Form -->
                        <form role="form">
                            <!-- Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Name</label>

                                <div class="col-md-9">
                                    <input id="edit-client-name" type="text" class="form-control"
                                           @keyup.enter="update" v-model="editForm.name">

                                    <span class="form-text text-muted">
                                        Something your users will recognize and trust.
                                    </span>
                                </div>
                            </div>

                            <!-- Redirect URL -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Redirect URL</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="redirect"
                                           @keyup.enter="update" v-model="editForm.redirect">

                                    <span class="form-text text-muted">
                                        Your application's authorization callback URL.
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="update">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        /*
         * The component's data.
         */
        data() {
            return {
                clients: [],

                createForm: {
                    errors: [],
                    name: '',
                    redirect: ''
                },

                editForm: {
                    errors: [],
                    name: '',
                    redirect: ''
                }
            };
        },

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },

        methods: {
            /**
             * Prepare the component.
             */
            prepareComponent() {
                this.getClients();

                $('#modal-create-client').on('shown.bs.modal', () => {
                    $('#create-client-name').focus();
                });

                $('#modal-edit-client').on('shown.bs.modal', () => {
                    $('#edit-client-name').focus();
                });
            },

            /**
             * Get all of the OAuth clients for the user.
             */
            getClients() {
                axios.get('/oauth/clients')
                    .then(response => {
                        this.clients = response.data;
                    });
            },

            /**
             * Show the form for creating new clients.
             */
            showCreateClientForm() {
                $('#modal-create-client').modal('show');
            },

            /**
             * Create a new OAuth client for the user.
             */
            store() {
                this.persistClient(
                    'post', '/oauth/clients',
                    this.createForm, '#modal-create-client'
                );
            },

            /**
             * Edit the given client.
             */
            edit(client) {
                this.editForm.id = client.id;
                this.editForm.name = client.name;
                this.editForm.redirect = client.redirect;

                $('#modal-edit-client').modal('show');
            },

            /**
             * Update the client being edited.
             */
            update() {
                this.persistClient(
                    'put', '/oauth/clients/' + this.editForm.id,
                    this.editForm, '#modal-edit-client'
                );
            },

            /**
             * Persist the client to storage using the given form.
             */
            persistClient(method, uri, form, modal) {
                form.errors = [];

                axios[method](uri, form)
                    .then(response => {
                        this.getClients();

                        form.name = '';
                        form.redirect = '';
                        form.errors = [];

                        $(modal).modal('hide');
                    })
                    .catch(error => {
                        if (typeof error.response.data === 'object') {
                            form.errors = _.flatten(_.toArray(error.response.data.errors));
                        } else {
                            form.errors = ['Something went wrong. Please try again.'];
                        }
                    });
            },

            /**
             * Destroy the given client.
             */
            destroy(client) {
                axios.delete('/oauth/clients/' + client.id)
                    .then(response => {
                        this.getClients();
                    });
            }
        }
    }
</script>
