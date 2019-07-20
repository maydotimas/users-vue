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

                    <a class="action-link" tabindex="-1" @click="showCreateUserForm">
                        Create New User
                    </a>
                </div>
            </div>

            <div class="card-body">

                <!-- Current Users -->
                <p class="mb-0" v-if="users.length === 0">
                    No user data to display at the moment.
                </p>

                <table class="table table-borderless mb-0" v-if="users.length > 0">
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
                    <tr v-for="user in users">
                        <td>
                            <input type="checkbox" v-bind:value="user.id" v-model="selected_users">
                        </td>
                        <!-- ID -->
                        <td style="vertical-align: middle;">
                            {{ user.id }}
                        </td>

                        <!-- Name -->
                        <td style="vertical-align: middle;">
                            {{ user.first_name }} {{ user.last_name }}
                        </td>

                        <td style="vertical-align: middle;">
                            {{ user.post_code }}
                        </td>
                        <td style="vertical-align: middle;">
                            {{ user.contact_phone_number }}
                        </td>
                        <td style="vertical-align: middle;">
                            {{ user.email }}
                        </td>
                        <td style="vertical-align: middle;">
                            {{ user.username }}
                        </td>

                        <!-- Edit Button -->
                        <td style="vertical-align: middle;">
                            <a class="action-link" tabindex="-1" @click="edit(user)">
                                Edit
                            </a>
                        </td>

                        <!-- Delete Button -->
                        <td style="vertical-align: middle;">
                            <a class="action-link text-danger" @click="destroy(user)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>


            </div>
        </div>

        <button class="btn btn-primary mt-10" @click="destroy_multiple">Delete</button>

        <!-- Create User Modal -->
        <div class="modal fade" id="modal-create-user" tabindex="-1" role="dialog">
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
                                    <input id="create-user-first-name" type="text"
                                           class="form-control"
                                           name="first_name" v-validate="'required|alpha_spaces'"
                                           @keyup.enter="store" v-model="createForm.first_name">
                                    <i v-show="errors.has('first_name')" class="fa fa-warning"></i>
                                    <span v-show="errors.has('first_name')" class="help is-danger">{{ errors.first('first_name') }}</span>

                                </div>
                            </div>
                            <!-- Last Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Last Name</label>

                                <div class="col-md-9">
                                    <input id="create-user-last-name" type="text" class="form-control"
                                           name="last_name" v-validate="'required|alpha_spaces'"
                                           @keyup.enter="store" v-model="createForm.last_name">
                                    <i v-show="errors.has('last_name')" class="fa fa-warning"></i>
                                    <span v-show="errors.has('last_name')" class="help is-danger">{{ errors.first('last_name') }}</span>

                                </div>
                            </div>

                            <!-- Address -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Address</label>

                                <div class="col-md-9">
                                    <input id="create-user-address" type="text" class="form-control"
                                           name="address" v-validate="'required'"
                                           @keyup.enter="store" v-model="createForm.address">
                                    <i v-show="errors.has('address')" class="fa fa-warning"></i>
                                    <span v-show="errors.has('address')" class="help is-danger">{{ errors.first('address') }}</span>

                                </div>
                            </div>

                            <!-- Post Code -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Post Code</label>

                                <div class="col-md-9">
                                    <input id="create-user-post-code" type="text" class="form-control"
                                           name="post_code" v-validate="'required|alpha_num'"
                                           @keyup.enter="store" v-model="createForm.post_code"
                                           max="10"
                                    >

                                    <i v-show="errors.has('post_code')" class="fa fa-warning"></i>
                                    <span v-show="errors.has('post_code')" class="help is-danger">{{ errors.first('post_code') }}</span>

                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Phone Number</label>

                                <div class="col-md-9">
                                    <input type="text" id="create-user-phone-number" class="form-control"
                                           name="contact_phone_number" v-validate="'required|numeric'"
                                           @keyup.enter="store" v-model="createForm.contact_phone_number">

                                    <i v-show="errors.has('contact_phone_number')" class="fa fa-warning"></i>
                                    <span v-show="errors.has('contact_phone_number')" class="help is-danger">{{ errors.first('contact_phone_number') }}</span>

                                </div>
                            </div>

                            <!-- Email -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Email</label>

                                <div class="col-md-9">
                                    <input type="text" id="create-user-email" class="form-control"
                                           name="email" v-validate="'required|email'"
                                           @keyup.enter="store" v-model="createForm.email">

                                    <i v-show="errors.has('email')" class="fa fa-warning"></i>
                                    <span v-show="errors.has('email')" class="help is-danger">{{ errors.first('email') }}</span>


                                </div>
                            </div>
                            <!-- Username -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Username</label>

                                <div class="col-md-9">
                                    <input type="text" id="create-user-username" class="form-control"
                                           name="username" v-validate="'required|alpha_num'"
                                           @keyup.enter="store" v-model="createForm.username">

                                    <i v-show="errors.has('username')" class="fa fa-warning"></i>
                                    <span v-show="errors.has('username')" class="help is-danger">{{ errors.first('username') }}</span>

                                </div>
                            </div>
                            <!-- Password -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Password</label>

                                <div class="col-md-9">
                                    <input type="password" id="create-user-password" class="form-control"
                                           name="password" v-validate="'required'"
                                           @keyup.enter="store" v-model="createForm.password">

                                    <span v-show="errors.has('password')" class="help is-danger">{{ errors.first('password') }}</span>

                                </div>
                            </div>
                            <!-- Password -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Password Confirm</label>

                                <div class="col-md-9">
                                    <input type="password" id="create-user-password-confirm" class="form-control"
                                           name="password_confirmation" v-validate="'required|confirmed:password'"
                                           @keyup.enter="store" v-model="createForm.password_confirmation">

                                    <span v-show="errors.has('password_confirmation')" class="help is-danger">{{ errors.first('password_confirmation') }}</span>

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

        <!-- Edit User Modal -->
        <div class="modal fade" id="modal-edit-user" tabindex="-1" role="dialog">
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
                            <!-- First Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">First Name</label>

                                <div class="col-md-9">
                                    <input id="edit-user-first-name" type="text"
                                           class="form-control"
                                           name="first_name" v-validate="'required|alpha_spaces'"
                                           @keyup.enter="store" v-model="editForm.first_name">
                                    <i v-show="errors.has('first_name')" class="fa fa-warning"></i>
                                    <span v-show="errors.has('first_name')" class="help is-danger">{{ errors.first('first_name') }}</span>

                                </div>
                            </div>
                            <!-- Last Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Last Name</label>

                                <div class="col-md-9">
                                    <input id="edit-user-last-name" type="text" class="form-control"
                                           name="last_name" v-validate="'required|alpha_spaces'"
                                           @keyup.enter="store" v-model="editForm.last_name">
                                    <i v-show="errors.has('last_name')" class="fa fa-warning"></i>
                                    <span v-show="errors.has('last_name')" class="help is-danger">{{ errors.first('last_name') }}</span>

                                </div>
                            </div>

                            <!-- Address -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Address</label>

                                <div class="col-md-9">
                                    <input id="edit-user-address" type="text" class="form-control"
                                           name="address" v-validate="'required'"
                                           @keyup.enter="store" v-model="editForm.address">
                                    <i v-show="errors.has('address')" class="fa fa-warning"></i>
                                    <span v-show="errors.has('address')" class="help is-danger">{{ errors.first('address') }}</span>

                                </div>
                            </div>

                            <!-- Post Code -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Post Code</label>

                                <div class="col-md-9">
                                    <input id="edit-user-post-code" type="text" class="form-control"
                                           name="post_code" v-validate="'required|alpha_num'"
                                           @keyup.enter="store" v-model="editForm.post_code"
                                           max="10"
                                    >

                                    <i v-show="errors.has('post_code')" class="fa fa-warning"></i>
                                    <span v-show="errors.has('post_code')" class="help is-danger">{{ errors.first('post_code') }}</span>

                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Phone Number</label>

                                <div class="col-md-9">
                                    <input type="text" id="edit-user-phone-number" class="form-control"
                                           name="contact_phone_number" v-validate="'required|numeric'"
                                           @keyup.enter="store" v-model="editForm.contact_phone_number">

                                    <i v-show="errors.has('contact_phone_number')" class="fa fa-warning"></i>
                                    <span v-show="errors.has('contact_phone_number')" class="help is-danger">{{ errors.first('contact_phone_number') }}</span>

                                </div>
                            </div>

                            <!-- Email -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Email</label>

                                <div class="col-md-9">
                                    <input type="text" id="edit-user-email" class="form-control"
                                           name="email" v-validate="'required|email'"
                                           @keyup.enter="store" v-model="editForm.email">

                                    <i v-show="errors.has('email')" class="fa fa-warning"></i>
                                    <span v-show="errors.has('email')" class="help is-danger">{{ errors.first('email') }}</span>


                                </div>
                            </div>
                            <!-- Username -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Username</label>

                                <div class="col-md-9">
                                    <input type="text" id="edit-user-username" class="form-control"
                                           name="username" v-validate="'required|alpha_num'"
                                           @keyup.enter="store" v-model="editForm.username">

                                    <i v-show="errors.has('username')" class="fa fa-warning"></i>
                                    <span v-show="errors.has('username')" class="help is-danger">{{ errors.first('username') }}</span>

                                </div>
                            </div>
                            <!-- Password -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Password</label>

                                <div class="col-md-9">
                                    <input type="password" id="edit-user-password" class="form-control"
                                           name="password"
                                           @keyup.enter="store" v-model="editForm.password">

                                </div>
                            </div>
                            <!-- Password -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Password Confirm</label>

                                <div class="col-md-9">
                                    <input type="password" id="edit-user-password-confirm" class="form-control"
                                           name="password_confirmation" v-validate="'confirmed:password'"
                                           @keyup.enter="store" v-model="editForm.password_confirmation">

                                    <span v-show="errors.has('password_confirmation')" class="help is-danger">{{ errors.first('password_confirmation') }}</span>

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
                users: [],
                selected_users: [],

                createForm: {
                    errors: [],
                    first_name: '',
                    last_name: '',
                    address: '',
                    post_code: '',
                    contact_phone_number: '',
                    email: '',
                    username: '',
                    password: '',
                    password_confirmation: ''
                },

                editForm: {
                    errors: [],
                    id: '',
                    first_name: '',
                    last_name: '',
                    address: '',
                    post_code: '',
                    contact_phone_number: '',
                    email: '',
                    username: '',
                    password: '',
                    password_confirmation: ''
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
                this.getUsers();

                $('#modal-create-user').on('shown.bs.modal', () => {
                    $('#create-client-name').focus();
                });

                $('#modal-edit-user').on('shown.bs.modal', () => {
                    $('#edit-client-name').focus();
                });
            },

            /**
             * Get all of the OAuth clients for the user.
             */
            getUsers() {
                axios.get('/api/users')
                    .then(response => {
                        this.users = response.data;
                    });
            },

            /**
             * Show the form for creating new clients.
             */
            showCreateUserForm() {
                $('#modal-create-user').modal('show');
            },

            /**
             * Create a new OAuth client for the user.
             */
            store() {
                this.persistUser(
                    'post', '/api/users',
                    this.createForm, '#modal-create-user'
                );
            },

            /**
             * Edit the given client.
             */
            edit(user) {
                this.editForm.id = user.id;
                this.editForm.first_name = user.first_name;
                this.editForm.last_name = user.last_name;
                this.editForm.address = user.address;
                this.editForm.post_code = user.post_code;
                this.editForm.contact_phone_number = user.contact_phone_number;
                this.editForm.email = user.email;
                this.editForm.username = user.username;
                this.editForm.password = user.password;

                $('#modal-edit-user').modal('show');
            },


            /**
             * Update the client being edited.
             */
            update() {
                this.persistUser(
                    'put', '/api/users/' + this.editForm.id + '/update',
                    this.editForm, '#modal-edit-user'
                );
            },

            /**
             * Persist the client to storage using the given form.
             */
            persistUser(method, uri, form, modal) {
                form.errors = [];

                axios[method](uri, form)
                    .then(response => {
                        this.getUsers();

                        form.first_name = '';
                        form.last_name = '';
                        form.address = '';
                        form.post_code = '';
                        form.contact_phone_number = '';
                        form.email = '';
                        form.username = '';
                        form.password = '';
                        form.password_confirmation = '';
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
            destroy(user) {
                axios.delete('/api/users/' + user.id + '/delete')
                    .then(response => {
                        this.getUsers();
                    });
            },

            /**
             * Destroy the multiple client.
             */
            destroy_multiple() {
                axios.delete('/api/users/multiple-delete',
                    {data: {ids: this.selected_users}})
                    .then(response => {
                        this.getUsers();
                    });
            }
        }
    }
</script>
