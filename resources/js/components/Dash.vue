<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12">
        <v-row
          align="center"
          justify="center"
          class="grey lighten-5"
          style="height: 300px;"
        >
          <v-col cols="12" sm="3" m="3">
            <v-card class="mx-auto" color="yellow" hover shaped ripple to="/users">
              <v-card class="mx-auto" outlined color="blue-grey darken-4" dark>
                <v-row align="center" justify="center">
                  <v-icon
                    x-large
                    align="center"
                    height="300px"
                    justify="center"
                  >mdi-format-list-bulleted</v-icon>&nbsp;&nbsp;&nbsp;
                  <span class="title font-weight-light">Total Voters</span>
                </v-row>
              </v-card>
              <v-card-text dark>
                <v-row align="center" justify="center">
                  <v-col class="display-2 font-weight-bold h2" cols="12"> {{ tusers }}</v-col>
                </v-row>
              </v-card-text>
              <v-card-actions>
                <v-btn text>Explore</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col cols="12" sm="3" m="3">
            <v-card class="mx-auto" color="blue" dark hover shaped ripple to="/today-login">
              <v-card class="mx-auto" max-width="344" outlined color="#2196F darken-4" dark>
                <v-row align="center" justify="center">
                  <v-icon x-large align="center" height="200px" justify="center">mdi-login-variant</v-icon>&nbsp;&nbsp;&nbsp;
                  <span class="title font-weight-light">Total Votes</span>
                </v-row>
              </v-card>
              <v-card-text dark>
                <v-row align="center" justify="center">
                  <v-col class="display-2 font-weight-bold h2" cols="12"> {{ lusers }}</v-col>
                </v-row>
              </v-card-text>
              <v-card-actions>
                <v-btn text>Explore</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>

      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  props: {
    compo: "compouser",
  },
  data() {
    return {
      users: [],
      lusers: "",
      tusers: "",
    };
  },
  methods: {
    loadUsers() {
      axios.get("api/authuser").then(({ data }) => (this.users = data));
    },
    ecit() {
      axios.get("api/totalUsers").then((response) => {
        var total = JSON.stringify(response.data);
        this.tusers = total;
      });
      axios.get("api/totalLogins").then((response) => {
        var total = JSON.stringify(response.data);
        this.lusers = total;
      });
    },
  },
  created() {
    this.ecit();
    this.loadUsers();
  },
};
</script>