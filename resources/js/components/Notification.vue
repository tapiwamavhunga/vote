<template>
    <v-form
        @submit.prevent="createUser()"
        ref="form"
        v-model="valid"
        :lazy-validation="lazy"
    >
        <v-card>
            <v-card-title>
                <span class="headline">Notification Details</span>
            </v-card-title>

            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="12" md="12">
                            <v-col cols="12" sm="12" md="12">
                                <v-textarea
                                    v-model="form.description"
                                    label="Description"
                                    outlined
                                    dense
                                ></v-textarea>
                            </v-col>
                            <!-- <v-col cols="12" sm="12" md="12">
                                <v-text-field
                                    v-model="form.link"
                                    label="Link"
                                    outlined
                                    dense
                                ></v-text-field>
                            </v-col> -->
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="success"
                    class="mr-2"
                    :disabled="!valid"
                    type="submit"
                    >Send</v-btn
                >
            </v-card-actions>
        </v-card>
    </v-form>
</template>

<script>
export default {
    data: () => ({
        search: "",
        active: true,
        hasError: false,
        valid: true,
        users: [],
        dialog: false,
        show1: false,
        lazy: false,
        errs: [],
        form: new Form({
            id: "",
            description: "",
            link: ""
        }),

        headers: [
            {
                text: "ID",
                value: "id",
                align: "start",
                sortable: true
            },
            { text: "Name", value: "name" },
            { text: "Email", value: "email" },
            { text: "Actions", value: "actions", sortable: false }
        ],

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
            return this.editedIndex === -1 ? "New Voter" : "Edit Voter";
        }
    },

    watch: {
        dialog(val) {
            val || this.close();
        }
    },

    created() {
        Fire.$on("AfterCreate", () => {
            this.loadUsers();
        });
    },

    methods: {
        clear() {
            this.form.id = "";
            this.form.description = "";
            this.form.link = "";
        },

        newModal() {
            this.clear();
            this.dialog = true;
        },

        editItem(item) {
            this.clear();
            this.editedIndex = this.users.indexOf(item);
            this.form = Object.assign({}, item);
            this.dialog = true;
        },

        close() {
            this.dialog = false;
            this.$nextTick(() => {
                this.editedIndex = -1;
            });
        },

        createUser() {
            this.$Progress.start();
            axios
                .post("api/notification", {
                    id: this.form.id,
                    description: this.form.description,
                    link: this.form.link
                })
                .then(response => {
                    let gmsg = response.data.cod;
                    if (gmsg == 200) {
                        let title = response.data.status;
                        let body = response.data.msg;
                        Swal.fire(title, body, "success");
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
                            txt.name +
                            "*<br>" +
                            txt.email +
                            "*</ul><span>"
                    );
                    Swal.fire(title, body, "error");
                });
        }
    }
};
</script>
