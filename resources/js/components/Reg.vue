<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
            <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body">
            <v-tabs v-model="tab" background-color="deep-purple accent-4" centered icons-and-text>
              <v-tabs-slider></v-tabs-slider>

              <v-tab href="#tab-1">
                Login
                <v-icon>mdi-login</v-icon>
              </v-tab>
              <!-- <v-tab href="#tab-2">
                Register
                <v-icon>mdi-account-check</v-icon>
              </v-tab> -->
            </v-tabs>

            <v-tabs-items v-model="tab">
              <v-tab-item value="tab-1">
                <v-card flat>
                  <h5 class="card-title text-center mt-4">Login</h5>
                  <form class="form-signin">
                    <ul class="alert alert-danger list-group mb-4" v-if="form.errs.length > 0">
                      <li
                        class="list-group-item"
                        v-for="error in form.errs"
                        :key="form.errs.indexOf(error)"
                      >{{ error }}</li>
                    </ul>
                    <div class="form-label-group">
                      <input
                        type="email"
                        v-model="form.email"
                        id="lname"
                        class="form-control"
                        placeholder="Email address"
                        :class="{ 'is-invalid': form.errors.has('email') }"
                        required
                      />
                      <label for="lname">Email address</label>
                      <has-error :form="form" field="email"></has-error>
                    </div>
                    <hr />
                    <div class="form-label-group">
                      <input
                        type="text"
                        v-model="form.password"
                        id="lpass"
                        class="form-control"
                        placeholder="Passcode"
                        :class="{ 'is-invalid': form.errors.has('password') }"
                        required
                      />
                      <label for="lpass">Passcode</label>
                      <has-error :form="form" field="password"></has-error>
                    </div>
                    <button
                      class="btn btn-lg btn-primary btn-block text-uppercase"
                      :disabled="!isValidLoginForm"
                      @click="attemptLogin"
                      type="button"
                    >Sign In</button>
                  </form>
                </v-card>
              </v-tab-item>

              <v-tab-item value="tab-2">
                <v-card flat>
                  <h5 class="card-title text-center mt-4">Register</h5>
                  <form class="form-signin" @submit.prevent="createUser()">
                    <div class="form-label-group">
                      <input
                        type="text"
                        v-model="form.name"
                        id="rname"
                        class="form-control"
                        placeholder="Username"
                        required
                        :class="{ 'is-invalid': form.errors.has('name') }"
                        autofocus
                      />
                      <label for="rname">Username</label>
                      <has-error :form="form" field="name"></has-error>
                    </div>
                    <input v-model="form.type" type="hidden" name="type" value="User" />
                    <div class="form-label-group">
                      <input
                        type="email"
                        name="email"
                        id="remail"
                        v-model="form.email"
                        class="form-control"
                        placeholder="Email address"
                        :class="{ 'is-invalid': form.errors.has('email') }"
                        required
                      />
                      <label for="remail">Email address</label>
                      <has-error :form="form" field="email"></has-error>
                    </div>
                    <div class="form-label-group">
                      <input
                        type="text"
                        id="inputPhone"
                        v-model="form.phone"
                        class="form-control"
                        placeholder="Phone Number"
                        :class="{ 'is-invalid': form.errors.has('phone') }"
                        required
                      />
                      <label for="inputPhone">Phone Number</label>
                      <has-error :form="form" field="phone"></has-error>
                    </div>
                    <div class="form-label-group">
                      <input
                        type="password"
                        id="rpass"
                        v-model="form.password"
                        class="form-control"
                        placeholder="Password"
                        :class="{ 'is-invalid': form.errors.has('password') }"
                        required
                      />
                      <label for="rpass">Password</label>
                      <has-error :form="form" field="password"></has-error>
                    </div>
                    <button
                      class="btn btn-lg btn-primary btn-block text-uppercase"
                      type="submit"
                    >Register</button>
                  </form>
                </v-card>
              </v-tab-item>
            </v-tabs-items>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      tab: null,
      votp: false,
      form: new Form({
        id: "",
        name: "",
        email: "",
        phone: "",
        password: "",
        type: "User",
        remember: true,
        type: "User",
        status: "Active",
        errs: [],
      }),
    };
  },
  methods: {
    emailIsValid(mail) {
      if (
        /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.form.email)
      ) {
        return true;
      } else return false;
    },
    attemptLogin() {
      this.form.errs = [];
      axios
        .post("/login", {
          email: this.form.email,
          password: this.form.password,
          remember: this.form.remember,
        })
        .then((resp) => {
          window.location.assign("/home");
          toast({
            type: "success",
            title: "You have been successfully logged in.",
          });
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.form.errs.push("We couldn't verify your account details.");
          } else {
            this.form.errs.push(
              "Something went wrong, please refresh and try again." 
            );
          }
        });
    },
    attemptOtpLogin() {
      this.form.errs = [];
      if (this.form.otp) {
        axios
          .post("api/otplogin", {
            phone: this.form.phone,
            otp: this.form.otp,
          })
          .then((resp) => {
            // window.location.assign("/home");
            toast({
              type: "success",
              title: "You have been successfully logged in.",
            });
          })
          .catch((error) => {
            if (error.response.status == 422) {
              this.form.errs.push("We couldn't verify your account details.");
            } else {
              this.form.errs.push(
                "Something went wrong, please refresh and try again."
              );
            }
          });
      } else {
        axios
          .post("api/otpgenerate", {
            phone: this.form.phone,
            email: this.form.email,
            password: this.form.password,
          })
        .then((response) => {
          let gmsg = response.data.cod;
          if (gmsg == 200) {
            let title = response.data.status;
            let body = response.data.msg;
            Swal.fire(title, body, "success");
            this.$Progress.finish();
            this.votp = true;
          } else if (gmsg == 400) {
            let title = response.data.status;
            let body = response.data.msg;
            Swal.fire(title, body, "info");
            this.$Progress.finish();
          }
        })
        .catch((error) => {
          this.errs.push(JSON.stringify(error.response.data.errors));
          // console.log("DATATAT "+ this.errs);
          var txt = error.response.data.errors;
          // let title = error.response.status.toString();
          let title = "<span class='text-danger'>Validation Error!<span>";
          let body = JSON.stringify(
            "<span class='text-danger'><ul>" +
              "<br>" +
              txt.phone +
              "*<br>" +
              txt.otp +
              "*</ul><span>"
          );
          Swal.fire(title, body, "error");
        });
      }
    },

    createUser() {
      this.$Progress.start();
      this.form
        .post("api/user")
        .then((response) => {
          let gmsg = response.data.cod;
          if (gmsg == 200) {
            let title = response.data.status;
            let body = response.data.msg;
            Swal.fire(title, body, "success");
            this.$Progress.finish();
            window.location.assign("/home");
          } else if (gmsg == 400) {
            let title = response.data.status;
            let body = response.data.msg;
            Swal.fire(title, body, "info");
            this.$Progress.finish();
          }
        })
        .catch((error) => {
          this.errs.push(JSON.stringify(error.response.data.errors));
          // console.log("DATATAT "+ this.errs);
          var txt = error.response.data.errors;
          // let title = error.response.status.toString();
          let title = "<span class='text-danger'>Validation Error!<span>";
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
  },
  computed: {
    isValidLoginForm() {
      return this.emailIsValid() && this.form.password;
    },
    btnText() {
      return this.votp == true ? "Login" : "Send OTP";
    },
  },
};
</script>