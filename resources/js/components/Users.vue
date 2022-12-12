<template>
    <v-data-table
        :headers="headers"
        :items="users"
        sort-by="calories"
        class="elevation-1"
    >
        <template v-slot:top>
            <v-toolbar flat color="white">
                <v-toolbar-title>All Users</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="700px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            class="mb-3"
                            color="primary"
                            dark
                            rounded
                            v-bind="attrs"
                            v-on="on"
                            @click="newModal"
                        >
                            Add Users
                        </v-btn>
                    </template>
                    <v-form
                        @submit.prevent="editmode ? updateUser() : createUser()"
                        ref="form"
                        v-model="valid"
                        :lazy-validation="lazy"
                    >
                        <v-card>
                            <v-card-title>
                                <span class="headline">{{ formTitle }}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="6" md="6">
                                            <v-text-field
                                                v-model="form.name"
                                                label="Name"
                                                :rules="[rules.required]"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="6">
                                            <v-text-field
                                                v-model="form.email"
                                                :rules="[
                                                    rules.required,
                                                    rules.email
                                                ]"
                                                label="E-mail"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="6">
                                            <v-text-field
                                                v-model="form.phone"
                                                type="number"
                                                :rules="[
                                                    rules.required,
                                                    rules.min
                                                ]"
                                                label="Phone"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="6">
                                            <v-text-field
                                                v-model="form.password"
                                                :append-icon="
                                                    show1
                                                        ? 'mdi-eye'
                                                        : 'mdi-eye-off'
                                                "
                                                :type="
                                                    show1 ? 'text' : 'password'
                                                "
                                                name="input-10-1"
                                                label="Enter Password"
                                                hint="At least 8 characters"
                                                counter
                                                @click:append="show1 = !show1"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="6">
                                            <v-select
                                                v-model="form.type"
                                                :items="utypes"
                                                :rules="[
                                                    v =>
                                                        !!v ||
                                                        'Item is required'
                                                ]"
                                                label="User Type"
                                            ></v-select>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="12">
                                            <label for="myfile"
                                                >Select a file:</label
                                            >
                                            <input
                                                type="file"
                                                @change="onFileChange1"
                                            />
                                            <v-img
                                                v-bind:src="
                                                    pic1 + form.image
                                                "
                                                aspect-ratio="1.7"
                                                contain
                                                height="140px"
                                                class="py-3 rounded-pill"
                                            ></v-img>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn
                                    color="success"
                                    class="mr-2"
                                    v-show="!editmode"
                                    :disabled="!valid"
                                    type="submit"
                                >
                                    Submit
                                </v-btn>
                                <v-btn
                                    color="secondary"
                                    class="mr-2"
                                    @click="close"
                                >
                                    Cancel
                                </v-btn>
                                <v-btn
                                    color="success"
                                    class="mr-2"
                                    v-show="editmode"
                                    type="submit"
                                    :disabled="!valid"
                                >
                                    Update
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-form>
                </v-dialog>
            </v-toolbar>
        </template>
        <template v-slot:item.actions="{ item }">
            <v-icon
                medium
                class="mr-2"
                color="blue darken-1"
                @click="editItem(item)"
            >
                mdi-pencil
            </v-icon>
            <v-icon medium color="red darken-1" @click="deleteItem(item)">
                mdi-delete
            </v-icon>
        </template>
        <template v-slot:no-data>
            <v-btn color="primary" @click="loadUsers">Reset</v-btn>
        </template>
    </v-data-table>
</template>

<script>
export default {
    data: () => ({
        active: true,
        pic1: "/img/books/",
        hasError: false,
        valid: true,
        users: [],
        editmode: true,
        dialog: false,
        show1: false,
        errs: [],
        lazy: false,
        form: new Form({
            id: "",
            name: "",
            email: "",
            password: "",
            phone: "",
            reason: "",
            image: "",
            type: "User",
            status: "Active"
        }),

        headers: [
            {
                text: "ID",
                value: "id",
                align: "start",
                sortable: true
            },
            {
                text: "Name",
                value: "name"
            },
            { text: "Email", value: "email" },
            { text: "Voted To", value: "voted_to" },
            { text: "Voting Time", value: "voted_time" },
            { text: "Type", value: "type" },
            { text: "Last Login", value: "login_at" },
            { text: "IP Address", value: "login_ip" },
            { text: "Actions", value: "actions", sortable: false }
        ],

        select: null,
        utypes: ["Admin", "User"],

        editedIndex: -1,

        rules: {
            required: value => !!value || "Required.",
            min: v => v.length >= 10 || "Min 10 characters",
            micro: v => v.length >= 8 || "Min 8 characters",
            max: v => v.length <= 191 || "Max 191 characters",
            email: v => /.+@.+\..+/.test(v) || "E-mail must be valid",
            num: v => /.+@.+\..+/.test(v) || "E-mail must be valid"
        }
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "New User" : "Edit User";
        }
    },

    watch: {
        dialog(val) {
            val || this.close();
        }
    },

    created() {
        Fire.$on("searching", () => {
            let query = this.$parent.search;
            axios
                .get("api/findUser?q=" + query)
                .then(data => {
                    this.users = data.data;
                })
                .catch(() => {
                    console.log("Not Working..");
                });
        });
        this.loadUsers();
        Fire.$on("AfterCreate", () => {
            this.loadUsers();
            this.pic1 = "/img/books/";
        });
    },

    methods: {
        loadUsers() {
            axios.get("api/user").then(({ data }) => (this.users = data));
        },
        onFileChange1(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            console.log(file);
            this.pic1 = "";

            if (file["size"] < 5111775) {
                reader.onloadend = file => {
                    this.form.image = reader.result;
                };
                reader.readAsDataURL(file);
            } else {
                swal({
                    type: "error",
                    title: "Oops...",
                    text: "You are uploading a large file"
                });
            }
        },
        clear() {
            this.form.id = "";
            this.form.name = "";
            this.form.image = "";
            this.form.email = "";
            this.form.password = "";
            this.form.phone = "";
            this.form.reason = "";
            this.form.type = "User";
            this.form.status = "Active";
            this.errors = "";
        },

        newModal() {
            this.clear();
            this.dialog = true;
            this.editmode = false;
        },

        editItem(item) {
            this.editmode = true;
            this.clear();
            this.editedIndex = this.users.indexOf(item);
            this.form = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                //Send request to the server
                if (result.value) {
                    axios
                        .delete("api/user/" + item.id)
                        .then(() => {
                            Toast.fire({
                                type: "success",
                                title: "File has been deleted."
                            });
                            Fire.$emit("AfterCreate");
                        })
                        .catch(() => {
                            Swal.fire(
                                "Failed!",
                                "There was something wrong.",
                                "warning"
                            );
                        });
                }
            });
        },

        close() {
            this.dialog = false;
            this.$nextTick(() => {
                this.editedIndex = -1;
            });
        },

        updateUser() {
            let data = this.form;
            this.$Progress.start();
            axios
                .put("api/user/" + this.form.id, {
                    id: this.form.id,
                    name: this.form.name,
                    image: this.form.image,
                    email: this.form.email,
                    password: this.form.password,
                    phone: this.form.phone,
                    status: this.form.status,
                    reason: this.form.reason,
                    type: this.form.type
                })
                .then(response => {
                    let gmsg = response.data.cod;
                    if (gmsg == 200) {
                        let title = response.data.status;
                        let body = response.data.msg;
                        Swal.fire(title, body, "success");
                        this.dialog = false;
                        this.$Progress.finish();
                        Fire.$emit("AfterCreate");
                    } else if (gmsg == 400) {
                        let title = response.data.status;
                        let body = response.data.msg;
                        Swal.fire(title, body, "info");
                        Fire.$emit("AfterCreate");
                        this.$Progress.finish();
                    }
                })
                .catch(error => {
                    this.errs.push(JSON.stringify(error.response.data.errors));
                    // console.log("DATATAT "+ this.errs);
                    var txt = error.response.data.errors;
                    // let title = error.response.status.toString();
                    let title =
                        "<span class='text-danger'>Validation Error!<span>";
                    let body = JSON.stringify(
                        "<span class='text-danger'><ul>" +
                            "<br>" +
                            txt.email +
                            "*<br>" +
                            txt.password +
                            "*</ul><span>"
                    );
                    Swal.fire(title, body, "error");
                });
        },

        createUser() {
            this.$Progress.start();
            axios
                .post("api/user", {
                    id: this.form.id,
                    name: this.form.name,
                    image: this.form.image,
                    email: this.form.email,
                    password: this.form.password,
                    phone: this.form.phone,
                    status: this.form.status,
                    reason: this.form.reason,
                    type: this.form.type
                })
                .then(response => {
                    let gmsg = response.data.cod;
                    if (gmsg == 200) {
                        let title = response.data.status;
                        let body = response.data.msg;
                        Swal.fire(title, body, "success");
                        this.$Progress.finish();
                        Fire.$emit("AfterCreate");
                        this.dialog = false;
                    } else if (gmsg == 400) {
                        let title = response.data.status;
                        let body = response.data.msg;
                        Swal.fire(title, body, "info");
                        Fire.$emit("AfterCreate");
                        this.$Progress.finish();
                    }
                })
                .catch(error => {
                    this.errs.push(JSON.stringify(error.response.data.errors));
                    // console.log("DATATAT "+ this.errs);
                    var txt = error.response.data.errors;
                    // let title = error.response.status.toString();
                    let title =
                        "<span class='text-danger'>Validation Error!<span>";
                    let body = JSON.stringify(
                        "<span class='text-danger'><ul>" +
                            "<br>" +
                            txt.email +
                            "*<br>" +
                            txt.password +
                            "*</ul><span>"
                    );
                    Swal.fire(title, body, "error");
                });
        }
    }
};
</script>
