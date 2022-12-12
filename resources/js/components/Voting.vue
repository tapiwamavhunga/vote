<template>
    <v-app id="inspire">
        <v-container>
            <v-form
                @submit.prevent="createUser()"
                ref="form"
                v-model="valid"
                :lazy-validation="lazy"
            >
                <v-card>
                    <v-card-title>
                        <span class="headline"
                            >Please select the candidate and then click on
                            vote</span
                        >
                    </v-card-title>

                    <v-card-text>
                        <v-container>
                            <v-row>
                                <div
                                    v-for="(user, index) in users"
                                    :key="`${index}`"
                                >
                                    <v-card elevation="2" class="mx-1">
                                        <v-col cols="12" sm="12" md="12">
                                            <v-img
                                                v-bind:src="pic1 + user.image"
                                                aspect-ratio="1.7"
                                                contain
                                                height="110px"
                                                widtht="150px"
                                                class="py-3 rounded-pill"
                                            ></v-img>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="12">
                                            <input
                                                type="radio"
                                                :value="user.email"
                                                id="mainCat.merchantId"
                                                v-model="form.email"
                                                @change="check($event)"
                                            />
                                            {{ user.name }}
                                        </v-col>
                                    </v-card>
                                </div>
                            </v-row>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-container>
                            <v-container>
                                <v-btn
                                    block
                                    color="primary"
                                    elevation="3"
                                    x-large
                                    class="pa-6"
                                    type="submit"
                                    >Vote</v-btn
                                >
                            </v-container>
                        </v-container>
                    </v-card-actions>
                </v-card>
            </v-form>
        </v-container>
    </v-app>
</template>

<script>
export default {
    data: () => ({
        search: "",
        pic1: "/img/books/",
        radioGroup: "",
        active: true,
        hasError: false,
        valid: true,
        disabled: false,
        users: [],
        checkedCategories: "",
        show1: false,
        lazy: false,
        form: new Form({
            email: ""
        }),

        editedIndex: -1
    }),

    created() {
        this.loadUsers();
    },

    methods: {
        check: function(e) {
            console.log(this.form.email);
        },
        clear() {
            this.form.name = "";
            this.form.email = "";
            this.form.user_id = "";
            this.form.candidate = "";
            this.form.candidate_email = "";
            this.form.voting_time = "";
            this.form.voting_date = "";
            this.form.ip = "";
            this.form.device = "";
        },
        loadUsers() {
            axios.get("api/candidates").then(({ data }) => (this.users = data));
        },
        createUser() {
            // let title = "Voted";
            // let body = "Successfully Voted!";
            // Swal.fire(title, body, "success");
            // console.log("Users: " + this.radioGroup);
            this.$Progress.start();
            axios
                .post("api/voted", {
                    email: this.form.email
                })
                .then(response => {
                    let gmsg = response.data.cod;
                    if (gmsg == 200) {
                        let title = response.data.status;
                        let body = response.data.msg;
                        Swal.fire(title, body, "success");
                        this.$Progress.finish();
                        window.location.assign(APP_URL + "/logout");
                    } else if (gmsg == 400) {
                        let title = response.data.status;
                        let body = response.data.msg;
                        Swal.fire(title, body, "info");
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
